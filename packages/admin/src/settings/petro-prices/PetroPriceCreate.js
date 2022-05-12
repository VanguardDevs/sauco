import * as React from 'react'
import { validatePetroPrice } from './petroPriceValidations';
import BaseForm from '@sauco/lib/components/BaseForm'
import InputContainer from '@sauco/lib/components/InputContainer'
import TextInput from '@sauco/lib/components/TextInput'
import { axios, history } from '@sauco/lib/providers'


const PetroPriceCreate = props => {
    const [loading, setLoading] = React.useState(false)
    const [loaded, setLoaded] = React.useState(false)

    const save = React.useCallback(async (values) => {
        setLoading(true)

        try {
            const { data } = await axios.post('/petro-prices', values)

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
            history.push('/petro-prices')
        }
    }, [loaded])

    return (
        <BaseForm
            save={save}
            validate={validatePetroPrice}
            loading={loading}
            formName='Agregar valor'
            unresponsive
        >
            <InputContainer labelName='Valor'>
                <TextInput
                    name="value"
                    placeholder="Valor"
                    fullWidth
                />
            </InputContainer>
        </BaseForm>
    )
}

PetroPriceCreate.defaultProps = {
    basePath: '/petro-prices',
    resource: 'petro-prices'
}

export default PetroPriceCreate
