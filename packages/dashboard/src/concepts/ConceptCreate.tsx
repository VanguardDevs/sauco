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
    NumberInput,
    useRedirect,
    BooleanInput,
    useNotify
} from 'react-admin'
import { Box, Grid, InputLabel, Card, Typography } from '@material-ui/core'

const ConceptCreateForm: React.FC<any> = props => (
    <FormWithRedirect
        {...props}
        initialValues={{
            'charging_method_id': 2
        }}
        render={ ({ handleSubmitWithRedirect, saving }) => (
            <Card>
                <Box maxWidth="90em" padding='2em'>
                    <Grid container spacing={1}>
                        <Typography variant="h6" gutterBottom>
                            {'Nuevo concepto de recaudación'}
                        </Typography>
                    </Grid>
                    <Grid container spacing={1}>
                        <Grid item xs={12} sm={12} md={3}>
                            <InputLabel>Código</InputLabel>
                            <NumberInput
                                label={false}
                                source="code"
                                placeholder="Ejemplo: 000.000.000"
                                fullWidth
                            />
                        </Grid>
                        <Grid item xs={12} sm={12} md={4}>
                            <InputLabel>Cuentas contable</InputLabel>
                            <ReferenceInput
                                source="accounting_account_id"
                                reference="accounting-accounts"
                                sort={{ field: 'id', order: 'ASC' }}
                                label=''
                                fullWidth
                            >
                                <SelectInput optionText="name" />
                            </ReferenceInput>
                        </Grid>
                        <Grid item xs={12} sm={12} md={4}>
                            <InputLabel>Tipo de liquidación</InputLabel>
                            <ReferenceInput
                                source="liquidation_type_id"
                                reference="liquidation-types"
                                sort={{ field: 'id', order: 'ASC' }}
                                label=''
                                fullWidth
                            >
                                <SelectInput optionText="name" />
                            </ReferenceInput>
                        </Grid>
                        <Grid item xs={12} sm={12} md={12}>
                            <InputLabel>Nombre</InputLabel>
                            <TextInput
                                label={false}
                                source="name"
                                fullWidth
                            />
                        </Grid>
                        <Grid item xs={12} sm={12} md={3}>
                            <InputLabel>¿Simultáneo o moroso?</InputLabel>
                            <BooleanInput
                                source="own_income"
                                label={false}
                                fullWidth
                            />
                        </Grid>
                        <Grid item xs={12} sm={12} md={3}>
                            <InputLabel>Monto</InputLabel>
                            <NumberInput
                                source="amount"
                                label={false}
                                fullWidth
                            />
                        </Grid>
                        <Grid item xs={12} sm={12} md={4}>
                            <InputLabel>Ordenanza</InputLabel>
                            <ReferenceInput
                                source="ordinance_id"
                                reference="ordinances"
                                sort={{ field: 'id', order: 'ASC' }}
                                label=''
                                fullWidth
                            >
                                <SelectInput optionText="description" />
                            </ReferenceInput>
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

const ConceptCreate: React.FC<any> = (props: CreateProps) => {
    const createControllerProps = useCreateController(props);
    const [mutate, { data, loaded }] = useMutation();
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
        if (data && loaded) {
            notify('¡Ha creado una nueva firma!', 'success');
            redirect(`/concepts`)
        }
    }, [data, loaded]);

    return (
        <CreateContextProvider value={createControllerProps}>
            <ConceptCreateForm save={save} />
        </CreateContextProvider>
    )
}

export default ConceptCreate
