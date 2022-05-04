import * as React from 'react'
import {
    FormWithRedirect,
    SaveButton,
    useEditController,
    useMutation,
    EditContextProvider,
    ReferenceInput,
    SelectInput,
    useRedirect,
    useNotify
} from 'react-admin'
import { Box, Grid, InputLabel, Card, Typography } from '@material-ui/core'
import TextInput from '@sauco/lib/components/TextInput'

const SignatureEditForm = props => {
    console.log(props)
    return (
        <FormWithRedirect
            {...props}
            render={ ({ handleSubmitWithRedirect, saving }) => (
                <Card>
                    <Box maxWidth="90em" padding='2em'>
                        <Grid container spacing={1}>
                            <Typography variant="h6" gutterBottom>
                                {'Nueva firma'}
                            </Typography>
                        </Grid>
                        <Grid container spacing={1}>
                            <Grid item xs={12} sm={12} md={6}>
                                <InputLabel>Título</InputLabel>
                                <TextInput
                                    name="title"
                                    placeholder="Ejemplo: Lic. Pérez Quijada"
                                    fullWidth
                                />
                            </Grid>
                            <Grid item xs={12} sm={12} md={6}>
                                <InputLabel>Decreto</InputLabel>
                                <TextInput
                                    name="decree"
                                    placeholder="Ejemplo: Resolución Nº de fecha..."
                                    fullWidth
                                />
                            </Grid>
                            <Grid item xs={12} sm={12} md={3}>
                                <InputLabel>Usuario</InputLabel>
                                <ReferenceInput
                                    source="user_id"
                                    reference="users"
                                    sort={{ field: 'id', order: 'ASC' }}
                                    label=''
                                    fullWidth
                                >
                                    <SelectInput source="login" optionText="login" />
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
}

const SignatureEdit = props => {
    const editControllerProps = useEditController(props);
    const [mutate, { data, loaded }] = useMutation();
    const redirect = useRedirect();
    const notify = useNotify();

    const save = React.useCallback(async (values) => {
        try {
            await mutate({
                type: 'update',
                resource: props.resource,
                payload: { data: values }
            }, { returnPromise: true })
        } catch (error) {
            if (error.response.data.errors) {
                return error.response.data.errors;
            }
        }
    }, [mutate])

    React.useEffect(() => {
        if (data && loaded) {
            notify('¡Se ha actualizado la firma de manera exitosa!', 'success');
            redirect(`signatures`)
        }
    }, [data, loaded]);

    return (
        <EditContextProvider value={editControllerProps}>
            <SignatureEditForm {...editControllerProps} />
        </EditContextProvider>
    )
}

export default SignatureEdit
