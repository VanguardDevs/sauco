import * as React from 'react'
import { validateLiqueurClassification } from './liqueurclassificationValidations';
import BaseForm from '@sauco/lib/components/BaseForm'
import InputContainer from '@sauco/lib/components/InputContainer'
import { useParams } from 'react-router-dom'
import TextInput from '@sauco/lib/components/TextInput'
import { axios, history } from '@sauco/lib/providers'


const LiqueurClassificationEdit = props => {
    const { id } = useParams();
    const [loading, setLoading] = React.useState(false)
    const [loaded, setLoaded] = React.useState(false)
    const [record, setRecord] = React.useState(null)

    const save = React.useCallback(async (values) => {
        setLoading(true)
        try {
            const { data } = await axios.put(`/liqueur-classifications/${id}`, values)

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
        const { data } = await axios.get(`/liqueur-classifications/${id}`);

        setRecord(data);
    }, []);

    React.useEffect(() => {
        if (loaded) {
            history.push('/liqueur-classifications')
        }
    }, [loaded])

    React.useEffect(() => {
        fetchRecord()
    }, [])

    return (
        <BaseForm
            save={save}
            validate={validateLiqueurClassification}
            record={record}
            saveButtonLabel='Actualizar'
            loading={loading}
            formName="Editar Clasificación"
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

LiqueurClassificationEdit.defaultProps = {
    basePath: '/liqueur-classifications',
    resource: '/liqueur-classifications'
}

export default LiqueurClassificationEdit
