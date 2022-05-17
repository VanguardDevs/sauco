import * as React from 'react'
import {
    NumberInput,
    NullableBooleanInput,
} from 'react-admin'
import { validateConcept } from './conceptValidations';
import BaseForm from '@sauco/lib/components/BaseForm'
import InputContainer from '@sauco/lib/components/InputContainer'
import TextInput from '@sauco/lib/components/TextInput'
import { axios, history } from '@sauco/lib/providers'
import SelectInput from '@sauco/lib/components/SelectInput'


const ConceptCreate = () => {

    const [loading, setLoading] = React.useState(false)
    const [loaded, setLoaded] = React.useState(false)
    const [intervals, setIntervals] = React.useState([])
    const [chargingmethods, setChargingMethods] = React.useState([])
    const [accountingaccounts, setAccountingAccounts] = React.useState([])
    const [ordinances, setOrdinances] = React.useState([])    
    const [liquidationtypes, setLiquidationTypes] = React.useState([])


    const save = React.useCallback(async (values) => {
        setLoading(true)

        try {
            const { data } = await axios.post('/concepts', values)

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
            history.push('/concepts')
        }
    }, [loaded])

    
    const fetchIntervals = React.useCallback(async () => {
        const { data } = await axios.get('/intervals');

        setIntervals(data.data);
    }, []);


    const fetchChargingMethods = React.useCallback(async () => {
        const { data } = await axios.get('/charging-methods');

        setChargingMethods(data.data);
    }, []);


    const fetchAccountingAccounts = React.useCallback(async () => {
        const { data } = await axios.get('/accounting-accounts');

        setAccountingAccounts(data.data);
    }, []);


    const fetchOrdinances = React.useCallback(async () => {
        const { data } = await axios.get('/ordinances');

        setOrdinances(data.data);
    }, []);


    const fetchLiquidationTypes = React.useCallback(async () => {
        const { data } = await axios.get('/liquidation-types');

        setLiquidationTypes(data.data);
    }, []);



    React.useEffect(() => {
        fetchIntervals();
        fetchChargingMethods();
        fetchAccountingAccounts();
        fetchOrdinances();
        fetchLiquidationTypes();
    }, [])


    return (
        <BaseForm
            save={save}
            validate={validateConcept}
            loading={loading}
            formName='Agregar Concepto'
            unresponsive
        >

            <InputContainer labelName='Nombre'>
                <TextInput
                    name="name"
                    placeholder="Nombre"
                    fullWidth
                />
            </InputContainer>
            <InputContainer labelName='Código'>
                <TextInput
                    name="code"
                    placeholder="Código"
                    fullWidth
                />
            </InputContainer>

            <InputContainer labelName='Cantidad Mínima'>
                <NumberInput source="min_amount" />
            </InputContainer>
            <InputContainer labelName='Cantidad Máxima'>
                <NumberInput source="max_amount" />
            </InputContainer>

            <InputContainer labelName='Ingresos propios'>
                <NullableBooleanInput
                    source="own_income"
                    nullLabel=" "
                    falseLabel="Si"
                    trueLabel="No"
                />
            </InputContainer>

            <InputContainer labelName='Requisitos'>
                <NullableBooleanInput
                    source="has_requisite"
                    nullLabel=" "
                    falseLabel="Si"
                    trueLabel="No"
                />
            </InputContainer>

            <InputContainer labelName='Intervalos'>
                <SelectInput name="interval_id" options={intervals} />
            </InputContainer>

            <InputContainer labelName='Método de Pago'>
                <SelectInput name="charging_method_id" options={chargingmethods} />
            </InputContainer>

            <InputContainer labelName='Cuenta Contable'>
                <SelectInput name="accounting_account_id" options={accountingaccounts} />
            </InputContainer>

            <InputContainer labelName='Ordenanzas'>
                <SelectInput name="ordinance_id" options={ordinances} />
            </InputContainer>

            <InputContainer labelName='Tipo de Liquidación'>
                <SelectInput name="liquidation_type_id" options={liquidationtypes} />
            </InputContainer>


        </BaseForm>
    )
}

ConceptCreate.defaultProps = {
    basePath: '/concepts',
    resource: 'concepts'
}

export default ConceptCreate
