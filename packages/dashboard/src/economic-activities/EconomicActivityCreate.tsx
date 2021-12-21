import * as React from 'react'
import {
    TextInput,
    FormWithRedirect,
    CreateProps,
    useCreateController,
    useMutation,
    SaveButton,
    CreateContextProvider,
    useRedirect,
    useNotify
} from 'react-admin';
import { Box, Grid, InputLabel, Card, Typography } from '@material-ui/core'

interface FormValues {
    name?: string;
    code?: string;
    min_tax?: string;
    aliquote?: string;
};

const validate = (values: FormValues) => {
    const errors: FormValues = {};

    if (!values.name) {
        errors.name = "Ingrese el nombre";
    }
    if (!values.code) {
        errors.code = "Ingrese un código";
    }
    if (!values.min_tax) {
        errors.min_tax = "Ingrese un mínimo tributable";
    }
    if (!values.aliquote) {
        errors.aliquote = "Ingrese una alícuota";
    }

    return errors;
};

const TaxpayerCreateForm: React.FC<any> = props => (
    <FormWithRedirect
        {...props}
        render={ ({ handleSubmitWithRedirect, saving }) => (
            <Card>
                <Box maxWidth="90em" padding='2em'>
                    <Grid container spacing={1}>
                        <Typography variant="h6" gutterBottom>
                            {'Crear actividad económica'}
                        </Typography>
                    </Grid>
                    <Grid container spacing={1}>
                        <Grid item xs={12} sm={12} md={4}>
                            <InputLabel>Código</InputLabel>
                            <TextInput
                                label={false}
                                source="code"
                                placeholder="Ej. María Pérez"
                                fullWidth
                            />
                        </Grid>
                        <Grid item xs={12} sm={12} md={4}>
                            <InputLabel>Alícuota</InputLabel>
                            <TextInput
                                label={false}
                                source="aliquote"
                                placeholder="Ej. María Pérez"
                                fullWidth
                            />
                        </Grid>
                        <Grid item xs={12} sm={12} md={4}>
                            <InputLabel>Mínimo Tributable</InputLabel>
                            <TextInput
                                label={false}
                                source="min_tax"
                                placeholder="Ej. María Pérez"
                                fullWidth
                            />
                        </Grid>
                        <Grid item xs={12} sm={12} md={12}>
                            <InputLabel>Nombre de la actividad</InputLabel>
                            <TextInput
                                label={false}
                                source="name"
                                placeholder="Ej. María Pérez"
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
            notify('¡Ha ingresado una nueva actividad económica!', 'success');
            redirect(`/economic-activities`)
        }
    }, [data, loaded]);

    return (
        <CreateContextProvider value={createControllerProps}>
            <TaxpayerCreateForm save={save} validate={validate} />
        </CreateContextProvider>
    )
}

export default TaxpayerCreate
