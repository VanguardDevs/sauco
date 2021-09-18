import {
    Edit,
    SimpleForm,
    TextInput,
    EditProps,
    ReferenceInput,
    SelectInput
} from 'react-admin';
import validate from './validateParishes'
import { useFormState } from 'react-final-form'

const MunicipalitiesSelectInput = (props: any) => {
    const { values } = useFormState();

    if (values.state_id) {
        return (
            <ReferenceInput
                source="municipality_id"
                reference="municipalities"
                sort={{ field: 'id', order: 'ASC' }}
                label=''
                filter={{ state_id: values.state_id }}
                fullWidth
            >
                <SelectInput source="name" />
            </ReferenceInput>
        )
    }

    return null;
}

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
                source="state_id"
                reference="states"
                sort={{ field: 'id', order: 'ASC' }}
                label=''
                fullWidth
            >
                <SelectInput source="name" />
            </ReferenceInput>
            <MunicipalitiesSelectInput />
        </SimpleForm>
    </Edit>
);

export default ParishEdit;
