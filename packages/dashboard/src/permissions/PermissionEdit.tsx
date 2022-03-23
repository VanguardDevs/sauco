import {
    Edit,
    SimpleForm,
    TextInput,
    EditProps,
} from 'react-admin';
import validate from './validatePermission'

const PermissionEdit = (props: EditProps) => (
    <Edit {...props}>
        <SimpleForm validate={validate}>
            <TextInput
                label={false}
                source="name"
                fullWidth
            />
        </SimpleForm>
    </Edit>
);

export default PermissionEdit;
