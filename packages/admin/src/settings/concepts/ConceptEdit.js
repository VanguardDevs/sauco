import * as React from 'react'
import {
    useMutation,
    NumberInput,
    NullableBooleanInput,
    ReferenceInput,
    useEditController,
    useRedirect,
    useNotify
} from 'react-admin'
import { validateConcept } from './conceptValidations';
import BaseForm from '@sauco/lib/components/BaseForm'
import InputContainer from '@sauco/lib/components/InputContainer'
import { useParams } from 'react-router-dom'
import TextInput from '@sauco/lib/components/TextInput'
import { axios, history } from '@sauco/lib/providers'
import SelectInput from '@sauco/lib/components/SelectInput'

const ConceptEdit = props => {
    const { id } = useParams();
    const editControllerProps = useEditController({
        ...props,
        id: id
    });
    const [mutate, { data, loading, loaded }] = useMutation();
    const redirect = useRedirect()
    const notify = useNotify();

    const save = React.useCallback(async (values) => {
        try {
            await mutate({
                type: 'update',
                resource: props.resource,
                payload: { id: record.id, data: values }
            }, { returnPromise: true })
        } catch (error) {
            if (error.response.data.errors) {
                return error.response.data.errors;
            }
        }
    }, [mutate])

    React.useEffect(() => {
        if (loaded) {
            notify(`¡Ha editado el parametro "${data.name}" exitosamente!`, 'success')
            redirect('/concepts')
        }
    }, [loaded])

    const { record } = editControllerProps

    return (
        <BaseForm
            save={save}
            validate={validateConcept}
            record={record}
            saveButtonLabel='Actualizar'
            loading={loading}
            formName="Editar Parámetro"
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

ConceptEdit.defaultProps = {
    basePath: '/concepts',
    resource: '/concepts'
}

export default ConceptEdit
