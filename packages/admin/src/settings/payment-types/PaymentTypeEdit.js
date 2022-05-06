import * as React from 'react'
import {
    useMutation,
    useEditController,
    useRedirect,
    useNotify
} from 'react-admin'
import { validatePaymentType } from './paymentTypeValidations';
import BaseForm from '@sauco/lib/components/BaseForm'
import InputContainer from '@sauco/lib/components/InputContainer'
import { useParams } from 'react-router-dom'
import TextInput from '@sauco/lib/components/TextInput'

const PaymentTypeEdit = props => {
    const { id } = useParams();
    const editControllerProps = useEditController({
        ...props,
        id: id
    });
    const [mutate, { data, loading, loaded }] = useMutation();
    const redirect = useRedirect()
    const notify = useNotify();

    const save = React.useCallback(async (values) => {
        try {
            await mutate({
                type: 'update',
                resource: props.resource,
                payload: { id: record.id, data: values }
            }, { returnPromise: true })
        } catch (error) {
            if (error.response.data.errors) {
                return error.response.data.errors;
            }
        }
    }, [mutate])

    React.useEffect(() => {
        if (loaded) {
            notify(`¡Ha editado el tipo de pago "${data.name}" exitosamente!`, 'success')
            redirect('/payment-types')
        }
    }, [loaded])

    const { record } = editControllerProps

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
