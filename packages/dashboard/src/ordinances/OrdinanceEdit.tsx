import {
    Edit,
    SimpleForm,
    TextInput,
    EditProps,
} from 'react-admin';

interface FormValues {
    description?: string;
}

const validate = (values: FormValues) => {
    const errors: FormValues = {};

    if (!values.description) {
        errors.description = "Ingrese el nombre del rubro";
    }

    return errors;
};

const OrdinanceEdit = (props: EditProps) => (
    <Edit {...props}>
        <SimpleForm validate={validate} redirect='/ordinances'>
            <TextInput
                label={false}
                source="description"
                fullWidth
            />
        </SimpleForm>
    </Edit>
);

export default OrdinanceEdit;
