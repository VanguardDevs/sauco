import * as React from 'react'
import {
    NumberInput,
    NullableBooleanInput,
} from 'react-admin'
import { validateLiqueurParameter } from './liqueurparameterValidations';
import BaseForm from '@sauco/lib/components/BaseForm'
import InputContainer from '@sauco/lib/components/InputContainer'
import { useParams } from 'react-router-dom'
import { axios, history } from '@sauco/lib/providers'
import SelectInput from '@sauco/lib/components/SelectInput'

const LiqueurParameterEdit = props => {
    const { id } = useParams();
    const [loading, setLoading] = React.useState(false)
    const [loaded, setLoaded] = React.useState(false)
    const [liqueurzones, setLiqueurZones] = React.useState([])
    const [liqueurclassifications, setLiqueurClassifications] = React.useState([])

    const [record, setRecord] = React.useState(null)

    const save = React.useCallback(async (values) => {
        setLoading(true)
        try {
            const { data } = await axios.put(`/liqueur-parameters/${id}`, values)

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


    React.useEffect(() => {
        if (loaded) {
            history.push('/liqueur-parameters')
        }
    }, [loaded])


    const fetchLiqueurClassifications = React.useCallback(async () => {
        const { data } = await axios.get('/liqueur-classifications');

        setLiqueurClassifications(data.data);
    }, []);


    const fetchLiqueurZones = React.useCallback(async () => {
        const { data } = await axios.get('/liqueur-zones');

        setLiqueurZones(data.data);
    }, []);

    const fetchRecord = React.useCallback(async () => {
        const { data } = await axios.get(`/liqueur-parameters/${id}`);

        setRecord(data);
    }, []);


    React.useEffect(() => {
        fetchLiqueurZones();
        fetchLiqueurClassifications();
        fetchRecord()

    }, [])


    return (
        <BaseForm
            save={save}
            validate={validateLiqueurParameter}
            record={record}
            saveButtonLabel='Actualizar'
            loading={loading}
            formName="Editar Parámetro"
        >

            <InputContainer labelName='Clasificación'>
                <SelectInput name="liqueur_classification_id" options={liqueurclassifications} record={record}/>
            </InputContainer>

            <InputContainer labelName='Zona'>
                <SelectInput name="liqueur_zone_id" options={liqueurzones} record={record}/>
            </InputContainer>

            <InputContainer labelName='Cantidad'>
                <NumberInput source="new_registry_amount" />
            </InputContainer>
            <InputContainer labelName='Cantidad'>
                <NumberInput source="renew_registry_amount" />
            </InputContainer>
            <InputContainer labelName='Movil'>
                <NullableBooleanInput
                    source="is_mobile"
                    nullLabel=" "
                    falseLabel="Inactivo"
                    trueLabel="Activo"
                />
            </InputContainer>
        </BaseForm>
    )
}

LiqueurParameterEdit.defaultProps = {
    basePath: '/liqueur-parameters',
    resource: '/liqueur-parameters'
}

export default LiqueurParameterEdit
