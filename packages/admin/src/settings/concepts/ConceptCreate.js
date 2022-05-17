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
    const [brands, setBrands] = React.useState([])

    const save = React.useCallback(async (values) => {
        try {
            await mutate({
                type: 'create',
                resource: props.resource,
                payload: { data: values }
            }, { returnPromise: true })
        } catch (error) {
            if (error.response.data.errors) {
                return error.response.data.errors;
            }
        }
    }, [mutate])

    React.useEffect(() => {
        if (loaded) {
            notify(`¡Ha registrado el concepto "${data.name}!`, 'success');
            redirect('/concepts')
        }
    }, [loaded])

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
                <ReferenceInput source="interval_id" reference="intervals" >
                    <SelectInput optionText="name" optionValue="id" />
                </ReferenceInput>
            </InputContainer>

            <InputContainer labelName='Método de Pago'>
                <ReferenceInput source="charging_method_id" reference="charging-methods" >
                    <SelectInput optionText="name" optionValue="id" />
                </ReferenceInput>
            </InputContainer>

            <InputContainer labelName='Cuenta Contable'>
                <ReferenceInput source="accounting_account_id" reference="accounting-accounts" >
                    <SelectInput optionText="name" optionValue="id" />
                </ReferenceInput>
            </InputContainer>


            <InputContainer labelName='Ordenanzas'>
                <ReferenceInput source="ordinance_id" reference="ordinances" >
                    <SelectInput optionText="description" optionValue="id" />
                </ReferenceInput>
            </InputContainer>

            <InputContainer labelName='Tipo de Liquidación'>
                <ReferenceInput source="liquidation_type_id" reference="liquidation-types" >
                    <SelectInput optionText="name" optionValue="id" />
                </ReferenceInput>
            </InputContainer>


        </BaseForm>
    )
}

ConceptCreate.defaultProps = {
    basePath: '/concepts',
    resource: 'concepts'
}

export default ConceptCreate
