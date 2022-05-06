import * as React from 'react'
import { validateModel } from './modelValidations';
import BaseForm from '@sauco/lib/components/BaseForm'
import InputContainer from '@sauco/lib/components/InputContainer'
import TextInput from '@sauco/lib/components/TextInput'
import { axios, history } from '@sauco/lib/providers'
import SelectInput from '@sauco/lib/components/SelectInput'

const ModelCreate = () => {
    const [loading, setLoading] = React.useState(false)
    const [loaded, setLoaded] = React.useState(false)
    const [brands, setBrands] = React.useState([])

    const save = React.useCallback(async (values) => {
        setLoading(true)

        try {
            const { data } = await axios.post('/vehicle-models', values)

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
            history.push('/vehicle-models')
        }
    }, [loaded])

    const fetchBrands = React.useCallback(async () => {
        const { data } = await axios.get('/brands');

        setBrands(data.data);
    }, []);

    React.useEffect(() => {
        fetchBrands();
    }, [])

    return (
        <BaseForm
            save={save}
            validate={validateModel}
            loading={loading}
            formName='Agregar modelo'
            unresponsive
        >
            <InputContainer labelName='Nombre'>
                <TextInput
                    name="name"
                    placeholder="Nombre"
                    fullWidth
                />
            </InputContainer>
            <InputContainer labelName='Marca'>
                <SelectInput name="brand_id" options={brands} />
            </InputContainer>
        </BaseForm>
    )
}

ModelCreate.defaultProps = {
    basePath: '/vehicle-models',
    resource: 'vehicle-models'
}

export default ModelCreate
