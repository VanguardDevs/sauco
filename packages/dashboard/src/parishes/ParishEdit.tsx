import {
    Edit,
    SimpleForm,
    TextInput,
    EditProps,
    ReferenceInput,
    SelectInput
} from 'react-admin';
import validate from './validateParishes'

const ParishEdit = (props: EditProps) => (
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
    </Edit>
);

export default ParishEdit;
