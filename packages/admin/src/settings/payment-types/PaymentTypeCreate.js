import * as React from 'react'
import { validatePaymentType } from './paymentTypeValidations';
import BaseForm from '@sauco/lib/components/BaseForm'
import InputContainer from '@sauco/lib/components/InputContainer'
import TextInput from '@sauco/lib/components/TextInput'
import { axios, history } from '@sauco/lib/providers'


const PaymentTypeCreate = props => {
    const [loading, setLoading] = React.useState(false)
    const [loaded, setLoaded] = React.useState(false)

    const save = React.useCallback(async (values) => {
        setLoading(true)

        try {
            const { data } = await axios.post('/payment-types', values)

            if (data) {
                setLoaded(true)
            }
        } catch (error) {
            if (error.response.data.errors) {
                return error.response.data.errors;
            }
        }

        setLoading(false)
    }, [])

    React.useEffect(() => {
        if (loaded) {
            history.push('/payment-types')
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
