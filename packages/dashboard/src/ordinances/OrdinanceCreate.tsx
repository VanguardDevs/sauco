import {
    Create,
    SimpleForm,
    TextInput,
    CreateProps,
} from 'react-admin';

interface FormValues {
    description?: string;
}

const validate = (values: FormValues) => {
    const errors: FormValues = {};

    if (!values.description) {
        errors.description = "Ingrese el nombre de la ordenanza";
    }

    return errors;
};

const OrdinanceCreate = (props: CreateProps) => (
    <Create {...props}>
        <SimpleForm validate={validate} redirect='/ordinances'>
            <TextInput
                label={false}
                source="description"
                placeholder="Ej. Débito"
                fullWidth
            />
        </SimpleForm>
    </Create>
);

export default OrdinanceCreate;
