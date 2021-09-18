import {
    Create,
    SimpleForm,
    TextInput,
    CreateProps,
    ReferenceInput,
    SelectInput
} from 'react-admin';
import validate from './validateParishes'

const ParishCreate = (props: CreateProps) => (
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
            <ReferenceInput
                source="municipality_id"
                reference="municipalities"
                sort={{ field: 'id', order: 'ASC' }}
                label=''
                fullWidth
            >
                <SelectInput source="name" />
            </ReferenceInput>
        </SimpleForm>
    </Create>
);

export default ParishCreate;
