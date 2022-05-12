import * as React from 'react'
import { validatePetroPrice } from './petroPriceValidations';
import BaseForm from '@sauco/lib/components/BaseForm'
import InputContainer from '@sauco/lib/components/InputContainer'
import { useParams } from 'react-router-dom'
import TextInput from '@sauco/lib/components/TextInput'
import { axios, history } from '@sauco/lib/providers'


const PetroPriceEdit = props => {
    const { id } = useParams();
    const [loading, setLoading] = React.useState(false)
    const [loaded, setLoaded] = React.useState(false)
    const [record, setRecord] = React.useState(null)

    const save = React.useCallback(async (values) => {
        setLoading(true)
        try {
            const { data } = await axios.put(`/petro-prices/${id}`, values)

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



    const fetchRecord = React.useCallback(async () => {
        const { data } = await axios.get(`/petro-prices/${id}`);

        setRecord(data);
    }, []);

    React.useEffect(() => {
        if (loaded) {
            history.push('/petro-prices')
        }
    }, [loaded])

    React.useEffect(() => {
        fetchRecord()
    }, [])

    return (
        <BaseForm
            save={save}
            validate={validatePetroPrice}
            record={record}
            saveButtonLabel='Actualizar'
            loading={loading}
            formName="Editar valor"
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

PetroPriceEdit.defaultProps = {
    basePath: '/petro-prices',
    resource: '/petro-prices'
}

export default PetroPriceEdit
