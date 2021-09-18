import {
    Create,
    SimpleForm,
    TextInput,
    CreateProps,
} from 'react-admin';
import validate from './validateState'

const StateCreate = (props: CreateProps) => (
    <Create {...props}>
        <SimpleForm validate={validate} redirect='/states'>
            <TextInput
                label={false}
                source="name"
                placeholder="Ej. Sucre"
                fullWidth
            />
            <TextInput
                label={false}
                source="code"
                placeholder="Ej. SUC"
                fullWidth
            />
        </SimpleForm>
    </Create>
);

export default StateCreate;
