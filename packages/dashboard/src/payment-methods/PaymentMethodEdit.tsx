import {
    Edit,
    SimpleForm,
    TextInput,
    EditProps,
} from 'react-admin';
import validate from './validatePaymentMethods'

const PaymentMethodEdit = (props: EditProps) => (
    <Edit {...props}>
        <SimpleForm validate={validate}>
            <TextInput
                label={false}
                source="name"
                fullWidth
            />
        </SimpleForm>
    </Edit>
);

export default PaymentMethodEdit;
