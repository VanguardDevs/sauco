import {
    Create,
    SimpleForm,
    TextInput,
    CreateProps,
} from 'react-admin';
import validate from './validatePermission'

const PermissionCreate = (props: CreateProps) => (
    <Create {...props}>
        <SimpleForm validate={validate} redirect='/permissions'>
            <TextInput
                label={false}
                source="name"
                placeholder="Ej. Débito"
                fullWidth
            />
        </SimpleForm>
    </Create>
);

export default PermissionCreate;
