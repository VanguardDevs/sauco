import * as React from 'react'
import {
    NumberInput,
    NullableBooleanInput,
} from 'react-admin'
import { validateLiqueurParameter } from './liqueurparameterValidations';
import BaseForm from '@sauco/lib/components/BaseForm'
import InputContainer from '@sauco/lib/components/InputContainer'
import { axios, history } from '@sauco/lib/providers'
import SelectInput from '@sauco/lib/components/SelectInput'

const LiqueurParameterCreate = props => {

    const [loading, setLoading] = React.useState(false)
    const [loaded, setLoaded] = React.useState(false)
    const [liqueurzones, setLiqueurZones] = React.useState([])
    const [liqueurclassifications, setLiqueurClassifications] = React.useState([])


    const save = React.useCallback(async (values) => {
        setLoading(true)

        try {
            const { data } = await axios.post('/liqueur-parameters', values)

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


    React.useEffect(() => {
        fetchLiqueurZones();
        fetchLiqueurClassifications();
    }, [])

    return (
        <BaseForm
            save={save}
            validate={validateLiqueurParameter}
            loading={loading}
            formName='Agregar Parametro'
            unresponsive
        >

            <InputContainer labelName='Clasificación'>
                <SelectInput name="liqueur_classification_id" options={liqueurclassifications} />
            </InputContainer>

            <InputContainer labelName='Zona'>
                <SelectInput name="liqueur_zone_id" options={liqueurzones} />
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

LiqueurParameterCreate.defaultProps = {
    basePath: '/liqueur-parameters',
    resource: 'liqueur-parameters'
}

export default LiqueurParameterCreate
