import * as React from 'react'
import {
    TextInput,
    FormWithRedirect,
    SaveButton,
    useCreateController,
    useMutation,
    CreateContextProvider,
    CreateProps
} from 'react-admin'
import { Box, Grid, InputLabel, Card, Typography } from '@material-ui/core'

const TaxpayerCreateForm: React.FC<any> = props => (
    <FormWithRedirect
        {...props}
        render={ ({ handleSubmitWithRedirect, saving }) => (
            <Card>
                <Box maxWidth="90em" padding='2em'>
                    <Grid container spacing={1}>
                        <Typography variant="h6" gutterBottom>
                            {'Datos generales'}
                        </Typography>
                    </Grid>
                    <Grid container spacing={1}>
                        <Grid item xs={12} sm={12} md={4}>
                            <InputLabel>Cédula de identidad</InputLabel>
                            <TextInput
                                label={false}
                                source="dni"
                                placeholder="123456789"
                                fullWidth
                            />
                        </Grid>
                        <Grid item xs={12} sm={12} md={4}>
                            <InputLabel>Primer nombre</InputLabel>
                            <TextInput
                                label={false}
                                source="first_name"
                                placeholder="Ej. María"
                                fullWidth
                            />
                        </Grid>
                        <Grid item xs={12} sm={12} md={4}>
                            <InputLabel>Apellido</InputLabel>
                            <TextInput
                                label={false}
                                source="surname"
                                placeholder="Ej. Pérez"
                                fullWidth
                            />
                        </Grid>
                        <Grid item xs={12} sm={12} md={4}>
                            <InputLabel>Nombre de usuario</InputLabel>
                            <TextInput
                                label={false}
                                source="login"
                                placeholder="Ej. María"
                                fullWidth
                            />
                        </Grid>
                        <Grid item xs={12} sm={12} md={4}>
                            <InputLabel>Teléfono</InputLabel>
                            <TextInput
                                label={false}
                                source="phone"
                                fullWidth
                            />
                        </Grid>
                        <Grid item xs={12} sm={12} md={4}>
                            <InputLabel>Contraseña</InputLabel>
                            <TextInput
                                label={false}
                                source="password"
                                fullWidth
                            />
                        </Grid>
                    </Grid>
                    <SaveButton handleSubmitWithRedirect={handleSubmitWithRedirect} saving={saving} />
                </Box>
            </Card>
        )}
    />
);

const TaxpayerCreate: React.FC<any> = (props: CreateProps) => {
    const createControllerProps = useCreateController(props);
    const [mutate] = useMutation();

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

    return (
        <CreateContextProvider value={createControllerProps}>
            <TaxpayerCreateForm save={save} />
        </CreateContextProvider>
    )
}

export default TaxpayerCreate
