import * as React from 'react'
import { validateYear } from './yearValidations';
import BaseForm from '@sauco/lib/components/BaseForm'
import InputContainer from '@sauco/lib/components/InputContainer'
import { useParams } from 'react-router-dom'
import TextInput from '@sauco/lib/components/TextInput'
import { axios, history } from '@sauco/lib/providers'


const YearEdit = props => {
    const { id } = useParams();
    const [loading, setLoading] = React.useState(false)
    const [loaded, setLoaded] = React.useState(false)
    const [record, setRecord] = React.useState(null)

    const save = React.useCallback(async (values) => {
        setLoading(true)
        try {
            const { data } = await axios.put(`/years/${id}`, values)

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
        const { data } = await axios.get(`/years/${id}`);

        setRecord(data);
    }, []);

    React.useEffect(() => {
        if (loaded) {
            history.push('/years')
        }
    }, [loaded])

    React.useEffect(() => {
        fetchRecord()
    }, [])

    return (
        <BaseForm
            save={save}
            validate={validateYear}
            record={record}
            saveButtonLabel='Actualizar'
            loading={loading}
            formName="Editar año"
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

YearEdit.defaultProps = {
    basePath: 'years',
    resource: 'years'
}

export default YearEdit
