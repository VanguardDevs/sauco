import {
    Edit,
    SimpleForm,
    TextInput,
    EditProps,
} from 'react-admin';

interface FormValues {
    name?: string;
}
  
const validate = (values: FormValues) => {
    const errors: FormValues = {};

    if (!values.name) {
        errors.name = "Ingrese el nombre del rubro";
    }

    return errors;
};

const ItemsEdit = (props: EditProps) => (
    <Edit {...props}>
        <SimpleForm validate={validate}>
            <TextInput
                label={false}
                source="name"
                placeholder="Ej. Avenida Libertad #217"
                fullWidth
            />
        </SimpleForm>
    </Edit>
);

export default ItemsEdit;
