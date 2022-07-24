import * as React from 'react'
import BaseForm from '../../components/BaseForm'
import InputContainer from '../../components/InputContainer'
import PasswordInput from '../../components/PasswordInput'
import axios from '../../api'
import { useSnackbar } from 'notistack';

const validateItem = (values) => {
    const errors = {}

    if (!values.current_password) {
        errors.current_password = "Ingrese su contraseña actual.";
    }
    if (!values.new_password) {
        errors.new_password = "Ingrese una nueva contraseña.";
    }
    if (!values.new_password_confirmation) {
        errors.new_password_confirmation = "Ingrese una nueva contraseña.";
    }
    if (values.current_password === values.new_password) {
        errors.new_password = "La nueva contraseña no debe ser igual a la anterior."
    }
    if (values.new_password !== values.new_password_confirmation) {
        errors.new_password_confirmation = "Las contraseñas no coinciden.";
    }

    return errors;
}

const Security = () => {
    const { enqueueSnackbar } = useSnackbar();

    const save = React.useCallback(async (values) => {
        try {
            const { data } = await axios.post('/update-password', values)

            if (data) {
                enqueueSnackbar(
                    `¡Ha actualizado su contraseña!"`,
                    { variant: 'success' }
                );
            }
        } catch (error) {
            if (error.response.data.errors) {
                return error.response.data.errors;
            }
        }
    }, [])

    return (
        <BaseForm
            save={save}
            validate={validateItem}
            title='Cambiar contraseña'
            unresponsive
        >
            <InputContainer label='Contraseña actual' md='8'>
                <PasswordInput
                    name="current_password"
                    placeholder="Contraseña actual"
                    fullWidth
                />
            </InputContainer>
            <InputContainer label='Nueva contraseña' md='8'>
                <PasswordInput
                    name="new_password"
                    placeholder="Nueva contraseña"
                    fullWidth
                />
            </InputContainer>
            <InputContainer label='Repita la nueva contraseña' md='8'>
                <PasswordInput
                    name="new_password_confirmation"
                    placeholder="Repita la nueva contraseña"
                    fullWidth
                />
            </InputContainer>
        </BaseForm>
    )
}

export default Security
