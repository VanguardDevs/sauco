import {
    Edit,
    SimpleForm,
    TextInput,
    EditProps,
    ReferenceInput,
    SelectInput
} from 'react-admin';
import validate from './validateMunicipality'

const MunicipalityEdit = (props: EditProps) => (
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
                source="state_id"
                reference="states"
                sort={{ field: 'id', order: 'ASC' }}
                label=''
                fullWidth
            >
                <SelectInput source="name" />
            </ReferenceInput>
        </SimpleForm>
    </Edit>
);

export default MunicipalityEdit;
