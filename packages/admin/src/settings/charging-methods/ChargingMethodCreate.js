import * as React from 'react'
import { validateChargingMethod } from './chargingMethodValidations';
import BaseForm from '@sauco/lib/components/BaseForm'
import InputContainer from '@sauco/lib/components/InputContainer'
import TextInput from '@sauco/lib/components/TextInput'
import { axios, history } from '@sauco/lib/providers'

const ChargingMethodCreate = props => {
    const [loading, setLoading] = React.useState(false)
    const [loaded, setLoaded] = React.useState(false)

    const save = React.useCallback(async (values) => {
        setLoading(true)

        try {
            const { data } = await axios.post('/charging-methods', values)

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
            history.push('/charging-methods')
        }
    }, [loaded])

    return (
        <BaseForm
            save={save}
            validate={validateChargingMethod}
            loading={loading}
            formName='Agregar Método de Pago'
            unresponsive
        >
            <InputContainer labelName='Nombre'>
                <TextInput
                    name="name"
                    placeholder="Nombre"
                    fullWidth
                />
            </InputContainer>
        </BaseForm>
    )
}

ChargingMethodCreate.defaultProps = {
    basePath: 'charging-methods',
    resource: 'charging-methods'
}

export default ChargingMethodCreate
