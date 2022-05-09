import * as React from 'react'
import { validateYear } from './yearValidations';
import BaseForm from '@sauco/lib/components/BaseForm'
import InputContainer from '@sauco/lib/components/InputContainer'
import TextInput from '@sauco/lib/components/TextInput'
import { axios, history } from '@sauco/lib/providers'


const YearCreate = props => {
    const [loading, setLoading] = React.useState(false)
    const [loaded, setLoaded] = React.useState(false)

    const save = React.useCallback(async (values) => {
        setLoading(true)

        try {
            const { data } = await axios.post('/years', values)

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
            history.push('/years')
        }
    }, [loaded])

    return (
        <BaseForm
            save={save}
            validate={validateYear}
            loading={loading}
            formName='Agregar Año'
            unresponsive
        >
            <InputContainer labelName='Año'>
                <TextInput
                    name="year"
                    placeholder="Año"
                    fullWidth
                />
            </InputContainer>
        </BaseForm>
    )
}

YearCreate.defaultProps = {
    basePath: '/years',
    resource: 'years'
}

export default YearCreate
