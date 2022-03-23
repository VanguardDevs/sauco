import {
    Create,
    SimpleForm,
    TextInput,
    CreateProps,
    ReferenceInput,
    SelectInput
} from 'react-admin';
import validate from './validateMunicipality'

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
            <ReferenceInput
                source="state_id"
                reference="states"
                sort={{ field: 'id', order: 'ASC' }}
                label=''
                fullWidth
            >
                <SelectInput source="name" />
            </ReferenceInput>
        </SimpleForm>
    </Create>
);

export default StateCreate;
