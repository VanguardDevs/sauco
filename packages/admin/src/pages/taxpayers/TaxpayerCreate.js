import * as React from 'react'
import { validateItem } from './taxpayerValidations';
import BaseForm from '../../components/BaseForm'
import InputContainer from '../../components/InputContainer'
import TextInput from '../../components/TextInput'
import axios from '../../api'
import { useNavigate } from 'react-router-dom'
import { useSnackbar } from 'notistack';
import { normalizePhone, normalizeRif } from './textFormatters';

const TaxpayerCreate = () => {
    const navigate = useNavigate()
    const { enqueueSnackbar } = useSnackbar();

    const save = React.useCallback(async (values) => {
        try {
            const { data } = await axios.post('/taxpayers', values)

            if (data) {
                navigate(`/taxpayers/${data.id}`)
                enqueueSnackbar(
                    `¡Ha registrado el contribuyente "${data.name}"!`, 
                    { variant: 'success' }
                );
            }
        } catch (error) {
            if (error.response.data.errors) {
                return error.response.data.errors;
            }
        }
    }, [])

    return (
        <BaseForm
            save={save}
            validate={validateItem}
            title='Agregar contribuyente'
            unresponsive
        >
            <InputContainer label='RIF'>
                <TextInput
                    name="rif"
                    parse={normalizeRif}
                    placeholder="R-12345678-9"
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
                    name="address"
                    placeholder="Dirección"
                    fullWidth
                />
            </InputContainer>
            <InputContainer label='Teléfono'>
                <TextInput
                    name="phone"
                    parse={normalizePhone}
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

export default TaxpayerCreate
