import * as React from 'react'
import {
    TextInput,
    useMutation,
    useRedirect,
    CreateProps,
    PasswordInput,
    useNotify,
    ReferenceInput,
    SelectInput
} from 'react-admin'
import InputContainer from '@sauco/common/components/InputContainer'
import BaseForm from '@sauco/common/components/BaseForm'
import validate from './validateUserSchema'

const UserCreate: React.FC<any> = (props: CreateProps) => {
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
            redirect('/users')
            notify(`¡Ha creado el usuario de ${data.login}`)
        }
    }, [loaded])

    return (
        <BaseForm
            save={save}
            validate={validate}
            buttonName='Guardar'
            title='Crear usuario'
            defaultValue={{
                isCreateForm: true
            }}
            {...props}
        >
            <InputContainer labelName='Cédula' xs={12} sm={12} md={4}>
                <TextInput
                    label={false}
                    source="identity_card"
                    placeholder="123456789"
                    fullWidth
                />
            </InputContainer>
            <InputContainer labelName='Nombre completo' xs={12} sm={12} md={4}>
                <TextInput
                    label={false}
                    source="full_name"
                    placeholder="Ej. María López"
                    fullWidth
                />
            </InputContainer>
            <InputContainer labelName='Nombre de usuario' xs={12} sm={12} md={4}>
                <TextInput
                    label={false}
                    source="login"
                    placeholder="Ej. María"
                    fullWidth
                />
            </InputContainer>
            <InputContainer labelName='Contraseña' xs={12} sm={12} md={4}>
                <PasswordInput
                    label={false}
                    source="password"
                    fullWidth
                />
            </InputContainer>
            <InputContainer labelName='Rol(es)' xs={12} sm={12} md={4}>
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
            </InputContainer>
        </BaseForm>
    )
}

export default UserCreate
