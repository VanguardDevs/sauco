import * as React from 'react'
import { validateCreateUser } from './userValidations';
import BaseForm from '../../components/BaseForm'
import InputContainer from '../../components/InputContainer'
import PasswordInput from '../../components/PasswordInput'
import TextInput from '../../components/TextInput'
import axios from '../../api'
import { useNavigate } from 'react-router-dom'
import { useSnackbar } from 'notistack';
import SelectRolesInput from './SelectRolesInput';
import { identityCard } from './userTextFormats'

const UserCreate = () => {
    const navigate = useNavigate()
    const { enqueueSnackbar } = useSnackbar();

    const save = React.useCallback(async (values) => {
        try {
            const { data } = await axios.post('/users', values)

            if (data) {
                navigate('/users')
                enqueueSnackbar(
                    `¡Ha registrado el usuario "${data.login}"`, 
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
            validate={validateCreateUser}
            title='Agregar usuario'
            unresponsive
        >
            <InputContainer label='Cédula de identidad'>
                <TextInput
                    name="identity_card"
                    placeholder="Cédula de identidad"
                    parse={identityCard}
                    fullWidth
                />
            </InputContainer>
            <InputContainer label='Nombre(s)'>
                <TextInput
                    name="names"
                    placeholder="Nombre"
                    fullWidth
                />
            </InputContainer>
            <InputContainer label='Apellido(s)'>
                <TextInput
                    name="surnames"
                    placeholder="Apellido(s)"
                    fullWidth
                />
            </InputContainer>
            <InputContainer label='Login'>
                <TextInput
                    name="login"
                    placeholder="Nombre de usuario"
                    fullWidth
                />
            </InputContainer>
            <InputContainer label='Contraseña'>
                <PasswordInput
                    name="password"
                    placeholder="Contraseña"
                    fullWidth
                />
            </InputContainer>
            <SelectRolesInput name='roles_ids' />
        </BaseForm>
    )
}

export default UserCreate
