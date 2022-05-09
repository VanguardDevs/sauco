import * as React from 'react'
import { validatePaymentType } from './paymentTypeValidations';
import BaseForm from '@sauco/lib/components/BaseForm'
import InputContainer from '@sauco/lib/components/InputContainer'
import { useParams } from 'react-router-dom'
import TextInput from '@sauco/lib/components/TextInput'
import { axios, history } from '@sauco/lib/providers'


const PaymentTypeEdit = props => {
    const { id } = useParams();
    const [loading, setLoading] = React.useState(false)
    const [loaded, setLoaded] = React.useState(false)
    const [record, setRecord] = React.useState(null)

    const save = React.useCallback(async (values) => {
        setLoading(true)
        try {
            const { data } = await axios.put(`/payment-types/${id}`, values)

            if (data) {
                setLoaded(true)
            }
        } catch (error) {
            if (error.response.data.errors) {
                return error.response.data.errors;
            }
        }
        setLoading(false)
    }, [id])


    const fetchRecord = React.useCallback(async () => {
        const { data } = await axios.get(`/payment-types/${id}`);

        setRecord(data);
    }, []);

    React.useEffect(() => {
        if (loaded) {
            history.push('/payment-types')
        }
    }, [loaded])

    React.useEffect(() => {
        fetchRecord()
    }, [])

    return (
        <BaseForm
            save={save}
            validate={validatePaymentType}
            record={record}
            saveButtonLabel='Actualizar'
            loading={loading}
            formName="Editar el Tipo de Pago"
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

PaymentTypeEdit.defaultProps = {
    basePath: 'payment-types',
    resource: 'payment-types'
}

export default PaymentTypeEdit
