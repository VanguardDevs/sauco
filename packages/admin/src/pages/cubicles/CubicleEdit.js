import * as React from 'react'
import { editCubicle } from './cubicleValidations';
import BaseForm from '../../components/BaseForm'
import InputContainer from '../../components/InputContainer'
import TextInput from '../../components/TextInput'
import { useNavigate, useParams } from 'react-router-dom'
import axios from '../../api'
import { useSnackbar } from 'notistack';
import SelectItemInput from './SelectItemInput';
import LoadingIndicator from '../../components/LoadingIndicator'

const CubicleEdit = () => {
    const { id } = useParams();
    const [record, setRecord] = React.useState(null)
    const navigate = useNavigate()
    const { enqueueSnackbar } = useSnackbar();

    const save = React.useCallback(async (values) => {
        try {
            const { data } = await axios.put(`/cubicles/${id}`, values)

            if (data) {
                navigate('/cubicles')
                enqueueSnackbar(`¡Ha actualizado el cubículo "${data.address}"`, { variant: 'success' });
            }
        } catch (error) {
            if (error.response.data.errors) {
                return error.response.data.errors;
            }
        }
    }, [id])

    const fetchRecord = React.useCallback(async () => {
        const { data } = await axios.get(`/cubicles/${id}`);

        setRecord(data);
    }, []);

    React.useEffect(() => {
        fetchRecord()
    }, [])

    if (!record) return <LoadingIndicator />;

    return (
        <BaseForm
            save={save}
            validate={editCubicle}
            record={record}
            saveButtonLabel='Actualizar'
            title={`Editando cubículo #${record.id}`}
        >
            <SelectItemInput />
            <InputContainer label='Dirección'>
                <TextInput
                    name="address"
                    placeholder="Dirección"
                    fullWidth
                />
            </InputContainer>
        </BaseForm>
    )
}

export default CubicleEdit
