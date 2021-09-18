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

const PaymentTypeEdit = (props: EditProps) => (
    <Edit {...props}>
        <SimpleForm validate={validate}>
            <TextInput
                label={false}
                source="description"
                fullWidth
            />
        </SimpleForm>
    </Edit>
);

export default PaymentTypeEdit;
