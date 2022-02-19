import * as React from 'react'
import { PasswordInput } from 'react-admin'
import { axios } from '@sauco/common/providers'
import InputContainer from '@sauco/common/components/InputContainer'
import BaseForm from '@sauco/common/components/BaseForm'

interface FormValues {
    current_password?: string;
    new_password?: string;
    new_password_confirmation?: string;
}

const validate = (values: FormValues) => {
    const errors: FormValues = {};

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
};

const UpdatePassword = (props: any) => {
    const save = React.useCallback(async (values) => {
        const { data } = await axios.post('update-password', values);

        console.log(data)
    }, [axios])

    return (
        <BaseForm save={save} validate={validate} {...props}>
            <InputContainer labelName='Contraseña actual' md={8}>
                <PasswordInput
                    source='current_password'
                    placeholder="Contraseña actual"
                    fullWidth
                />
            </InputContainer>
            <InputContainer labelName='Nueva contraseña' md={8}>
                <PasswordInput
                    source='new_password'
                    placeholder="Nueva contraseña"
                    fullWidth
                />
            </InputContainer>
            <InputContainer labelName='Nueva contraseña' md={8}>
                <PasswordInput
                    source='new_password_confirmation'
                    placeholder="Repita la nueva contraseña"
                    fullWidth
                />
            </InputContainer>
        </BaseForm>
    )
}

export default UpdatePassword
