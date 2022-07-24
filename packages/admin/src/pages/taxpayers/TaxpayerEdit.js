import * as React from 'react'
import { validateItem } from './taxpayerValidations';
import BaseForm from '../../components/BaseForm'
import InputContainer from '../../components/InputContainer'
import { useParams } from 'react-router-dom'
import TextInput from '../../components/TextInput'
import { useNavigate } from 'react-router-dom'
import axios from '../../api'
import { useSnackbar } from 'notistack';
import { normalizePhone, normalizeRif } from './textFormatters';

const TaxpayerEdit = () => {
    const { id } = useParams();
    const [record, setRecord] = React.useState(null)
    const navigate = useNavigate()
    const { enqueueSnackbar } = useSnackbar();

    const save = React.useCallback(async (values) => {
        try {
            const { data } = await axios.put(`/taxpayers/${id}`, values)

            if (data) {
                navigate(-1)
                enqueueSnackbar(
                    `¡Ha actualizado el contribuyente "${data.name}"`,
                    { variant: 'success' }
                );
            }
        } catch (error) {
            if (error.response.data.errors) {
                return error.response.data.errors;
            }
        }
    }, [id])

    const fetchRecord = React.useCallback(async () => {
        const { data } = await axios.get(`/taxpayers/${id}`);

        setRecord(data);
    }, []);

    React.useEffect(() => {
        fetchRecord()
    }, [])

    if (!record) return null;

    return (
        <BaseForm
            save={save}
            validate={validateItem}
            record={record}
            saveButtonLabel='Actualizar'
            title={`Editando contribuyente #${record.id}`}
        >
            <InputContainer label='RIF'>
                <TextInput
                    parse={normalizeRif}
                    name="rif"
                    placeholder="RIF"
                    fullWidth
                />
            </InputContainer>
            <InputContainer label='Razón social'>
                <TextInput
                    name="name"
                    placeholder="Razón Social"
                    fullWidth
                />
            </InputContainer>
            <InputContainer label='Dirección'>
                <TextInput
                    name="fiscal_address"
                    placeholder="Dirección"
                    fullWidth
                />
            </InputContainer>
            <InputContainer label='Teléfono'>
                <TextInput
                    parse={normalizePhone}
                    name="phone"
                    placeholder="Teléfono"
                    fullWidth
                />
            </InputContainer>
            <InputContainer label='Correo electrónico'>
                <TextInput
                    name="email"
                    placeholder="email@ejemplo.com"
                    fullWidth
                />
            </InputContainer>
        </BaseForm>
    )
}

export default TaxpayerEdit
