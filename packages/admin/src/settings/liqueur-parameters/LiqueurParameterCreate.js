import * as React from 'react'
import {
    NumberInput,
    NullableBooleanInput,
    ReferenceInput,
    SelectInput,
    useMutation,
    useRedirect,
    useNotify,
} from 'react-admin'
import { validateLiqueurParameter } from './liqueurparameterValidations';
import BaseForm from '@sauco/lib/components/BaseForm'
import InputContainer from '@sauco/lib/components/InputContainer'

const LiqueurParameterCreate = props => {
    const [mutate, { data, loading, loaded }] = useMutation();
    const redirect = useRedirect()
    const notify = useNotify();

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
            notify(`¡Ha registrado el parametro "${data.name}!`, 'success');
            redirect('/liqueur-parameters')
        }
    }, [loaded])

    return (
        <BaseForm
            save={save}
            validate={validateLiqueurParameter}
            loading={loading}
            formName='Agregar Parametro'
            unresponsive
        >


            <InputContainer labelName='Clasificación'>
                <ReferenceInput source="liqueur_classification_id" reference="liqueur-classifications" >
                    <SelectInput optionText="name" optionValue="id" />
                </ReferenceInput>
            </InputContainer>


            <InputContainer labelName='Zona'>
                <ReferenceInput source="liqueur_zone_id" reference="liqueur-zones" >
                    <SelectInput optionText="name" optionValue="id" />
                </ReferenceInput>
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
