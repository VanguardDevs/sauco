import {
    Create,
    SimpleForm,
    TextInput,
    CreateProps,
    NumberInput,
} from 'react-admin';
import validatePropertyUse from './validatePropertUse'

const OrdinanceCreate = (props: CreateProps) => (
    <Create {...props}>
        <SimpleForm validate={validatePropertyUse} redirect='/property-uses'>
            <TextInput
                label={false}
                source="name"
                placeholder="Nombre"
                fullWidth
            />
            <TextInput
                label={false}
                source="value"
                placeholder="0.0"
                fullWidth
            />
        </SimpleForm>
    </Create>
);

export default OrdinanceCreate;
