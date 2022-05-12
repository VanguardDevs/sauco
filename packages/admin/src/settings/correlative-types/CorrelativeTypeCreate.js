import * as React from 'react'
import { validateCorrelativeType } from './correlativeTypeValidations';
import BaseForm from '@sauco/lib/components/BaseForm'
import InputContainer from '@sauco/lib/components/InputContainer'
import TextInput from '@sauco/lib/components/TextInput'
import { axios, history } from '@sauco/lib/providers'


const CorrelativeTypeCreate = props => {
    const [loading, setLoading] = React.useState(false)
    const [loaded, setLoaded] = React.useState(false)

    const save = React.useCallback(async (values) => {
        setLoading(true)

        try {
            const { data } = await axios.post('/correlative-types', values)

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
            history.push('/correlative-types')
        }
    }, [loaded])

    return (
        <BaseForm
            save={save}
            validate={validateCorrelativeType}
            loading={loading}
            formName='Agregar Tipo de Correlativo'
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

CorrelativeTypeCreate.defaultProps = {
    basePath: 'correlative-types',
    resource: 'correlative-types'
}

export default CorrelativeTypeCreate
