import * as React from 'react'
import { validateLiqueurClassification } from './liqueurclassificationValidations';
import BaseForm from '@sauco/lib/components/BaseForm'
import InputContainer from '@sauco/lib/components/InputContainer'
import TextInput from '@sauco/lib/components/TextInput'
import { axios, history } from '@sauco/lib/providers'


const LiqueurClassificationCreate = props => {
    const [loading, setLoading] = React.useState(false)
    const [loaded, setLoaded] = React.useState(false)

    const save = React.useCallback(async (values) => {
        setLoading(true)

        try {
            const { data } = await axios.post('/liqueur-classifications', values)

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
            history.push('/liqueur-classifications')
        }
    }, [loaded])

    return (
        <BaseForm
            save={save}
            validate={validateLiqueurClassification}
            loading={loading}
            formName='Agregar clasificatión'
            unresponsive
        >
            <InputContainer labelName='Nombre'>
                <TextInput
                    name="name"
                    placeholder="Nombre"
                    fullWidth
                />
            </InputContainer>
            <InputContainer labelName='Abreviación'>
                <TextInput
                    name="abbreviature"
                    placeholder="Abreviación"
                    fullWidth
                />
            </InputContainer>
        </BaseForm>
    )
}

LiqueurClassificationCreate.defaultProps = {
    basePath: '/liqueur-classifications',
    resource: 'liqueur-classifications'
}

export default LiqueurClassificationCreate
