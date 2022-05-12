import * as React from 'react'
import { validateRepresentationType } from './representationTypeValidations';
import BaseForm from '@sauco/lib/components/BaseForm'
import InputContainer from '@sauco/lib/components/InputContainer'
import TextInput from '@sauco/lib/components/TextInput'
import { axios, history } from '@sauco/lib/providers'


const RepresentationTypeCreate = props => {
    const [loading, setLoading] = React.useState(false)
    const [loaded, setLoaded] = React.useState(false)

    const save = React.useCallback(async (values) => {
        setLoading(true)

        try {
            const { data } = await axios.post('/representation-types', values)

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
            history.push('/representation-types')
        }
    }, [loaded])

    return (
        <BaseForm
            save={save}
            validate={validateRepresentationType}
            loading={loading}
            formName='Agregar Tipo de Representante'
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

RepresentationTypeCreate.defaultProps = {
    basePath: 'representation-types',
    resource: 'representation-types'
}

export default RepresentationTypeCreate
