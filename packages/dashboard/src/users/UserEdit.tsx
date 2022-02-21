import * as React from 'react'
import {
    TextInput,
    useEditController,
    PasswordInput,
    EditProps,
    SelectInput,
    ReferenceInput,
    useRedirect,
    useNotify
} from 'react-admin'
import InputContainer from '@sauco/common/components/InputContainer'
import BaseForm from '@sauco/common/components/BaseForm'
import validate from './validateUserSchema'
import CachedIcon from '@material-ui/icons/Cached';

const UserEdit: React.FC<any> = (props: EditProps) => {
    const editControllerProps = useEditController(props);
    const redirect = useRedirect();
    const notify = useNotify();
    const { record, save, data, loaded } = editControllerProps

    React.useEffect(() => {
        if (data && loaded) {
            notify('¡Se ha actualizado el usuario de manera exitosa!', 'success');
            redirect(`/users`)
        }
    }, [data, loaded]);

    return (
        <BaseForm
            save={save}
            validate={validate}
            record={record}
            buttonName='Actualizar'
            title='Editar usuario'
            icon={<CachedIcon />}
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
                    placeholder="Ej. María"
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

export default UserEdit
