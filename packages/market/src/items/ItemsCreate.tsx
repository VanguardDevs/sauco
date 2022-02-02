import {
    Create,
    SimpleForm,
    TextInput,
    CreateProps,
} from 'react-admin';
import validate from './validate'

const ItemCreate = (props: CreateProps) => (
    <Create {...props}>
        <SimpleForm validate={validate} redirect='/items'>
            <TextInput
                label={false}
                source="name"
                placeholder="Ej. Avenida Libertad #217"
                fullWidth
            />
        </SimpleForm>
    </Create>
);

export default ItemCreate;
