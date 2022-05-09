import * as React from 'react'
import { validateBrand } from './brandValidations';
import BaseForm from '@sauco/lib/components/BaseForm'
import InputContainer from '@sauco/lib/components/InputContainer'
import TextInput from '@sauco/lib/components/TextInput'
import { axios, history } from '@sauco/lib/providers'


const BrandCreate = props => {
    const [loading, setLoading] = React.useState(false)
    const [loaded, setLoaded] = React.useState(false)

    const save = React.useCallback(async (values) => {
        setLoading(true)

        try {
            const { data } = await axios.post('/brands', values)

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
            history.push('/brands')
        }
    }, [loaded])

    return (
        <BaseForm
            save={save}
            validate={validateBrand}
            loading={loading}
            formName='Agregar marca'
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

BrandCreate.defaultProps = {
    basePath: '/brands',
    resource: 'brands'
}

export default BrandCreate
