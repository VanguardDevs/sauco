import * as React from 'react'
import { validateAnnex } from './annexValidations';
import BaseForm from '@sauco/lib/components/BaseForm'
import InputContainer from '@sauco/lib/components/InputContainer'
import TextInput from '@sauco/lib/components/TextInput'
import { axios, history } from '@sauco/lib/providers'


const AnnexCreate = props => {
    const [loading, setLoading] = React.useState(false)
    const [loaded, setLoaded] = React.useState(false)

    const save = React.useCallback(async (values) => {
        setLoading(true)

        try {
            const { data } = await axios.post('/liqueur-annexes', values)

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
            history.push('/liqueur-annexes')
        }
    }, [loaded])

    return (
        <BaseForm
            save={save}
            validate={validateAnnex}
            loading={loading}
            formName='Agregar anexo'
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

AnnexCreate.defaultProps = {
    basePath: '/liqueur-annexes',
    resource: 'liqueur-annexes'
}

export default AnnexCreate
