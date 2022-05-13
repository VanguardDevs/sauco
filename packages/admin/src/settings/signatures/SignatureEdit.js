import * as React from 'react'
import { NullableBooleanInput} from 'react-admin'
import { validateSignature } from './signatureValidations';
import BaseForm from '@sauco/lib/components/BaseForm'
import InputContainer from '@sauco/lib/components/InputContainer'
import { useParams } from 'react-router-dom'
import TextInput from '@sauco/lib/components/TextInput'
import { axios, history } from '@sauco/lib/providers'
import SelectInput from '@sauco/lib/components/SelectInput'

const SignatureEdit = props => {
    const { id } = useParams();
    const [loading, setLoading] = React.useState(false)
    const [loaded, setLoaded] = React.useState(false)
    const [users, setUsers] = React.useState([])
    const [record, setRecord] = React.useState(null)

    const save = React.useCallback(async (values) => {
        setLoading(true)
        try {
            const { data } = await axios.put(`/signatures/${id}`, values)

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


    const fetchUsers = React.useCallback(async () => {
        const { data } = await axios.get('/users');

        setUsers(data.data);
    }, []);
    const fetchRecord = React.useCallback(async () => {
        const { data } = await axios.get(`/signatures/${id}`);

        setRecord(data);
    }, []);

    React.useEffect(() => {
        if (loaded) {
            history.push('/signatures')
        }
    }, [loaded])

    React.useEffect(() => {
        fetchRecord()
        fetchUsers()
    }, [])

    return (
        <BaseForm
            save={save}
            validate={validateSignature}
            record={record}
            saveButtonLabel='Actualizar'
            loading={loading}
            formName="Editar Firma"
        >
            <InputContainer labelName='Título'>
                <TextInput
                    name="title"
                    placeholder="Título"
                    fullWidth
                />
            </InputContainer>
            <InputContainer labelName='Decreto'>
                <TextInput
                    name="decree"
                    placeholder="Decreto"
                    fullWidth
                />
            </InputContainer>
            <InputContainer labelName='Activo'>
                <NullableBooleanInput
                    source="active"
                    nullLabel=" "
                    falseLabel="Inactivo"
                    trueLabel="Activo"
                />
            </InputContainer>
            <InputContainer labelName='Usuario'>
                <SelectInput name="user_id" options={users} property={"names"} record={record} />
            </InputContainer>
        </BaseForm>
    )
}

SignatureEdit.defaultProps = {
    basePath: 'signatures',
    resource: 'signatures'
}

export default SignatureEdit
