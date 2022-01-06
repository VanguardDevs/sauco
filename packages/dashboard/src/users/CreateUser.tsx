import * as React from 'react'
import {
    TextInput,
    FormWithRedirect,
    SaveButton,
    useCreateController,
    useMutation,
    CreateContextProvider,
    useRedirect,
    CreateProps,
    PasswordInput,
    useNotify,
    ReferenceInput,
    SelectInput
} from 'react-admin'
import { Box, Grid, InputLabel, Card, Typography } from '@material-ui/core'

const UserCreateForm: React.FC<any> = props => (
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
                                source="identity_card"
                                placeholder="123456789"
                                fullWidth
                            />
                        </Grid>
                        <Grid item xs={12} sm={12} md={4}>
                            <InputLabel>Primer nombre</InputLabel>
                            <TextInput
                                label={false}
                                source="full_name"
                                placeholder="Ej. María"
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
                            <InputLabel>Contraseña</InputLabel>
                            <PasswordInput
                                label={false}
                                source="password"
                                fullWidth
                            />
                        </Grid>
                        <Grid item xs={12} sm={12} md={4}>
                            <InputLabel>Rol(es)</InputLabel>
                            <ReferenceInput
                                source="roles_ids"
                                reference="roles"
                            >
                                <SelectInput
                                    label={false}
                                    source="name"
                                    fullWidth
                                />
                            </ReferenceInput>
                        </Grid>
                    </Grid>
                    <SaveButton handleSubmitWithRedirect={handleSubmitWithRedirect} saving={saving} />
                </Box>
            </Card>
        )}
    />
);

const UserCreate: React.FC<any> = (props: CreateProps) => {
    const createControllerProps = useCreateController(props);
    const [mutate, { loaded, data }] = useMutation();
    const redirect = useRedirect()
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
            redirect('/users')
            notify(`¡Ha creado el usuario de ${data.login}`)
        }
    }, [loaded])

    return (
        <CreateContextProvider value={createControllerProps}>
            <UserCreateForm save={save} />
        </CreateContextProvider>
    )
}

export default UserCreate
