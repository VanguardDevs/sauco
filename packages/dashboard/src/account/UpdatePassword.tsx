import * as React from 'react'
import {
    useDataProvider,
    TextInput,
    FormWithRedirect,
    SaveButton
} from 'react-admin'
import { Box, Grid, InputLabel } from '@material-ui/core'
import UpdateIcon from '@material-ui/icons/Cached';

interface FormValues {
    current_password?: string;
    new_password?: string;
    new_password_confirm?: string;
}

const validate = (values: FormValues) => {
    const errors: FormValues = {};

    if (!values.current_password) {
        errors.current_password = "Ingrese su contraseña actual.";
    }
    if (!values.new_password) {
        errors.new_password = "Ingrese una nueva contraseña.";
    }
    if (!values.new_password_confirm) {
        errors.new_password_confirm = "Ingrese una nueva contraseña.";
    }
    if (values.current_password === values.new_password) {
        errors.new_password = "La nueva contraseña no debe ser igual a la anterior."
    }
    if (values.new_password !== values.new_password_confirm) {
        errors.new_password_confirm = "Las contraseñas no coinciden.";
    }

    return errors;
};

const UpdatePasswordForm = (props: any) => (
    <FormWithRedirect
        {...props}
        render={ ({ handleSubmitWithRedirect, saving }) => (
            <Box maxWidth="45em" paddingTop='2em'>
                <Grid container spacing={1}>
                    <Grid item xs={12}>
                        <InputLabel>Contraseña actual</InputLabel>
                        <TextInput
                            label={false} 
                            source='current_password' 
                            placeholder="Contraseña actual"
                            fullWidth
                        />
                    </Grid>
                    <Grid item xs={12}>
                        <InputLabel>Nueva contraseña</InputLabel>
                        <TextInput
                            label={false} 
                            source='new_password' 
                            placeholder="Nueva contraseña"
                            fullWidth
                        />
                    </Grid>
                    <Grid item xs={12}>
                        <InputLabel>Confirmación de contraseña</InputLabel>
                        <TextInput
                            label={false} 
                            source='new_password_confirm' 
                            placeholder="Repita la nueva contraseña"
                            fullWidth
                        />
                    </Grid>
                    <Grid item xs={12}>
                        <SaveButton
                            handleSubmitWithRedirect={
                                handleSubmitWithRedirect
                            }
                            saving={saving}
                            label='Actualizar'
                            icon={<UpdateIcon />}
                        />
                    </Grid>
                </Grid>
            </Box>
        )}
    />
);

const UpdatePassword = (props: any) => {
    const dataProvider = useDataProvider()

    const save = React.useCallback(async (values) => {
        const { data } = await dataProvider.post('update-password', values);

        console.log(data)
    }, [dataProvider])

    return (
        <UpdatePasswordForm save={save} validate={validate} {...props} />
    )
}

export default UpdatePassword
