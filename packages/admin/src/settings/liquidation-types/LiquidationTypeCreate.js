import * as React from 'react'
import { validateLiquidationType } from './liquidationTypeValidations';
import BaseForm from '@sauco/lib/components/BaseForm'
import InputContainer from '@sauco/lib/components/InputContainer'
import TextInput from '@sauco/lib/components/TextInput'
import { axios, history } from '@sauco/lib/providers'


const LiquidationTypeCreate = props => {
    const [loading, setLoading] = React.useState(false)
    const [loaded, setLoaded] = React.useState(false)

    const save = React.useCallback(async (values) => {
        setLoading(true)

        try {
            const { data } = await axios.post('/liquidation-types', values)

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
            history.push('/liquidation-types')
        }
    }, [loaded])

    return (
        <BaseForm
            save={save}
            validate={validateLiquidationType}
            loading={loading}
            formName='Agregar Tipo de Liquidación'
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

LiquidationTypeCreate.defaultProps = {
    basePath: 'liquidation-types',
    resource: 'liquidation-types'
}

export default LiquidationTypeCreate
