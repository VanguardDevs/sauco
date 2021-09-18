import {
    Create,
    SimpleForm,
    TextInput,
    CreateProps,
} from 'react-admin';
import validate from './validatePaymentMethods'

const PaymentMethodCreate = (props: CreateProps) => (
    <Create {...props}>
        <SimpleForm validate={validate} redirect='/payment-methods'>
            <TextInput
                label={false}
                source="name"
                placeholder="Ej. Transferencia"
                fullWidth
            />
        </SimpleForm>
    </Create>
);

export default PaymentMethodCreate;
