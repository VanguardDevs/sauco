import {
    Create,
    SimpleForm,
    TextInput,
    CreateProps,
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
