import * as React from 'react'
import { validateModel } from './modelValidations';
import BaseForm from '@sauco/lib/components/BaseForm'
import InputContainer from '@sauco/lib/components/InputContainer'
import { useParams } from 'react-router-dom'
import TextInput from '@sauco/lib/components/TextInput'
import { axios, history } from '@sauco/lib/providers'
import SelectInput from '@sauco/lib/components/SelectInput'

const ModelEdit = () => {
    const { id } = useParams();
    const [loading, setLoading] = React.useState(false)
    const [loaded, setLoaded] = React.useState(false)
    const [brands, setBrands] = React.useState([])
    const [record, setRecord] = React.useState(null)

    const save = React.useCallback(async (values) => {
        setLoading(true)
        try {
            const { data } = await axios.put(`/vehicle-models/${id}`, values)

            if (data) {
                setLoaded(true)
            }
        } catch (error) {
            if (error.response.data.errors) {
                return error.response.data.errors;
            }
        }
        setLoading(false)
    }, [id])

    const fetchBrands = React.useCallback(async () => {
        const { data } = await axios.get('/brands');

        setBrands(data.data);
    }, []);

    const fetchRecord = React.useCallback(async () => {
        const { data } = await axios.get(`/vehicle-models/${id}`);

        setRecord(data);
    }, []);

    React.useEffect(() => {
        if (loaded) {
            history.push('/vehicle-models')
        }
    }, [loaded])

    React.useEffect(() => {
        fetchBrands();
        fetchRecord()
    }, [])

    return (
        <BaseForm
            save={save}
            validate={validateModel}
            record={record}
            saveButtonLabel='Actualizar'
            loading={loading}
            formName="Editar Modelo"
        >
            <InputContainer labelName='Nombre'>
                <TextInput
                    name="name"
                    placeholder="Nombre"
                    fullWidth
                />
            </InputContainer>

            <InputContainer labelName='Marca'>
                <SelectInput name="brand_id" options={brands} record={record} />
            </InputContainer>
        </BaseForm>
    )
}

export default ModelEdit
