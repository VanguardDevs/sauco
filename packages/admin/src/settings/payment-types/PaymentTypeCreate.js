import * as React from 'react'
import {
    useMutation,
    useRedirect,
    useNotify,
} from 'react-admin'
import { validatePaymentType } from './paymentTypeValidations';
import BaseForm from '@sauco/lib/components/BaseForm'
import InputContainer from '@sauco/lib/components/InputContainer'
import TextInput from '@sauco/lib/components/TextInput'

const PaymentTypeCreate = props => {
    const [mutate, { data, loading, loaded }] = useMutation();
    const redirect = useRedirect()
    const notify = useNotify();

    const save = React.useCallback(async (values) => {
        try {
            await mutate({
                type: 'create',
                resource: props.resource,
                payload: { data: values }
            }, { returnPromise: true })
        } catch (error) {
            if (error.response.data.errors) {
                return error.response.data.errors;
            }
        }
    }, [mutate])

    React.useEffect(() => {
        if (loaded) {
            notify(`¡Ha registrado el tipo de pago "${data.name}!`, 'success');
            redirect('/payment-types')
        }
    }, [loaded])

    return (
        <BaseForm
            save={save}
            validate={validatePaymentType}
            loading={loading}
            formName='Agregar Tipo de Pago'
            unresponsive
        >
            <InputContainer labelName='Descripción'>
                <TextInput
                    name="description"
                    placeholder="Descripción"
                    fullWidth
                />
            </InputContainer>
        </BaseForm>
    )
}

PaymentTypeCreate.defaultProps = {
    basePath: 'payment-types',
    resource: 'payment-types'
}

export default PaymentTypeCreate
