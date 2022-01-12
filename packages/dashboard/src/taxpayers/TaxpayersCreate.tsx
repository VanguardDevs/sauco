import * as React from 'react'
import {
    TextInput,
    FormWithRedirect,
    SaveButton,
    useCreateController,
    useMutation,
    CreateContextProvider,
    CreateProps,
    ReferenceInput,
    SelectInput,
    useRedirect,
    useNotify
} from 'react-admin'
import { Box, Grid, InputLabel, Card, Typography } from '@material-ui/core'
import { useFormState } from 'react-final-form'
import validateTaxpayer from './validateTaxpayer'

const MunicipalitiesSelectInput = (props: any) => {
    const { values } = useFormState();

    if (values.state_id) {
        return (
            <Grid item xs={12} sm={12} md={4}>
                <InputLabel>Municipio</InputLabel>
                <ReferenceInput
                    source="municipality_id"
                    reference="municipalities"
                    sort={{ field: 'id', order: 'ASC' }}
                    label=''
                    filter={{ state_id: values.state_id }}
                    fullWidth
                >
                    <SelectInput source="name" />
                </ReferenceInput>
            </Grid>
        )
    }

    return null;
}

const ParishesSelectInput = (props: any) => {
    const { values } = useFormState();

    if (values.municipality_id) {
        return (
            <Grid item xs={12} sm={12} md={4}>
                <InputLabel>Parroquia</InputLabel>
                <ReferenceInput
                    source="parish_id"
                    reference="parishes"
                    sort={{ field: 'id', order: 'ASC' }}
                    label=''
                    filter={{ municipality_id: values.municipality_id }}
                    fullWidth
                >
                    <SelectInput source="name" />
                </ReferenceInput>
            </Grid>
        )
    }

    return null;
}

const TaxpayerCreateForm: React.FC<any> = props => (
    <FormWithRedirect
        {...props}
        validate={validateTaxpayer}
        render={ ({ handleSubmitWithRedirect, saving }) => (
            <Card>
                <Box maxWidth="90em" padding='2em'>
                    <Grid container spacing={1}>
                        <Typography variant="h6" gutterBottom>
                            {'Datos generales'}
                        </Typography>
                    </Grid>
                    <Grid container spacing={1}>
                        <Grid item xs={12} sm={12} md={6}>
                            <InputLabel>Nombre o Razón social</InputLabel>
                            <TextInput
                                label={false}
                                source="name"
                                placeholder="Ej. María Pérez"
                                fullWidth
                            />
                        </Grid>
                        <Grid item xs={12} sm={12} md={3}>
                            <InputLabel>Tipo</InputLabel>
                            <ReferenceInput
                                source="taxpayer_type_id"
                                reference="taxpayer-types"
                                sort={{ field: 'id', order: 'ASC' }}
                                label=''
                                fullWidth
                            >
                                <SelectInput source="description" optionText={'description'} />
                            </ReferenceInput>
                        </Grid>
                        <Grid item xs={12} sm={12} md={3}>
                            <InputLabel>Clasificación</InputLabel>
                            <ReferenceInput
                                source="taxpayer_classification_id"
                                reference="taxpayer-classifications"
                                sort={{ field: 'id', order: 'ASC' }}
                                label=''
                                fullWidth
                            >
                                <SelectInput source="name" />
                            </ReferenceInput>
                        </Grid>
                        <Grid item xs={12} sm={12} md={3}>
                            <InputLabel>RIF</InputLabel>
                            <TextInput
                                label={false}
                                source="rif"
                                placeholder="Ej. 12345678-9"
                                fullWidth
                            />
                        </Grid>
                        <Grid container spacing={1}>
                            <Typography variant="h6" gutterBottom>
                                {'Dirección'}
                            </Typography>
                        </Grid>
                        <Grid item xs={12} sm={12} md={4}>
                            <InputLabel>Estado</InputLabel>
                            <ReferenceInput
                                source="state_id"
                                reference="states"
                                sort={{ field: 'id', order: 'ASC' }}
                                label=''
                                fullWidth
                            >
                                <SelectInput source="name" />
                            </ReferenceInput>
                        </Grid>
                        <MunicipalitiesSelectInput />
                        <ParishesSelectInput />
                        <Grid item xs={12} sm={12} md={12}>
                            <InputLabel>Calle o avenida</InputLabel>
                            <TextInput
                                label={false}
                                source="address"
                                placeholder="Ej. Avenida Libertad #217"
                                fullWidth
                            />
                        </Grid>
                    </Grid>
                    <SaveButton
                        handleSubmitWithRedirect={
                            handleSubmitWithRedirect
                        }
                        saving={saving}
                    />
                </Box>
            </Card>
        )}
    />
);

const TaxpayerCreate: React.FC<any> = (props: CreateProps) => {
    const createControllerProps = useCreateController(props);
    const [mutate, { loaded, data }] = useMutation();
    const redirect = useRedirect();
    const notify = useNotify();

    const save = React.useCallback(async (values) => {
        try {
            await mutate({
                type: 'create',
                resource: props.resource,
                payload: { data: values }
            }, { returnPromise: true })
        } catch (error: any) {
            if (error.response.data.errors) {
                return error.response.data.errors;
            }
        }
    }, [mutate])

    React.useEffect(() => {
        if (loaded) {
            console.log(data)
            notify(`¡Ha registrado al contribuyente ${data.name}`)
            redirect(`/taxpayers/${data.id}/show`);
        }
    }, [loaded])

    return (
        <CreateContextProvider value={createControllerProps}>
            <TaxpayerCreateForm save={save} />
        </CreateContextProvider>
    )
}

export default TaxpayerCreate
