import {
    Edit,
    SimpleForm,
    TextInput,
    EditProps,
} from 'react-admin';
import validate from './validateState'

const StateEdit = (props: EditProps) => (
    <Edit {...props}>
        <SimpleForm validate={validate}>
            <TextInput
                label={false}
                source="name"
                fullWidth
            />
            <TextInput
                label={false}
                source="code"
                fullWidth
            />
        </SimpleForm>
    </Edit>
);

export default StateEdit;
