import * as React from 'react'
import {
    useMutation,
    NumberInput,
    NullableBooleanInput,
    useEditController,
    useRedirect,
    useNotify
} from 'react-admin'
import { validateLiqueurParameter } from './liqueurparameterValidations';
import BaseForm from '@sauco/lib/components/BaseForm'
import InputContainer from '@sauco/lib/components/InputContainer'
import { useParams } from 'react-router-dom'

const LiqueurParameterEdit = props => {
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
            redirect('/liqueur-parameters')
        }
    }, [loaded])

    const { record } = editControllerProps

    return (
        <BaseForm
            save={save}
            validate={validateLiqueurParameter}
            record={record}
            saveButtonLabel='Actualizar'
            loading={loading}
            formName="Editar Parámetro"
        >
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
