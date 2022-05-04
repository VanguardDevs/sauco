import * as React from 'react'
import {
    useMutation,
    NullableBooleanInput,
    useEditController,
    useRedirect,
    useNotify
} from 'react-admin'
import { validateVehicleParameter } from './vehicleparameterValidations';
import BaseForm from '@sauco/lib/components/BaseForm'
import InputContainer from '@sauco/lib/components/InputContainer'
import { useParams } from 'react-router-dom'
import TextInput from '@sauco/lib/components/TextInput'

const VehicleParameterEdit = props => {
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
            redirect('/vehicle-parameters')
        }
    }, [loaded])

    const { record } = editControllerProps

    return (
        <BaseForm
            save={save}
            validate={validateVehicleParameter}
            record={record}
            saveButtonLabel='Actualizar'
            loading={loading}
            formName="Editar parametro"
        >
            <InputContainer labelName='Nombre'>
                <TextInput
                    name="name"
                    placeholder="Nombre"
                    fullWidth
                />
            </InputContainer>

            <InputContainer labelName='Años'>

                <NullableBooleanInput
                    source="years"
                    nullLabel=" "
                    falseLabel="Inactivo"
                    trueLabel="Activo"
                />
            </InputContainer>

            <InputContainer labelName='Peso'>

                <NullableBooleanInput
                    source="weight"
                    nullLabel=" "
                    falseLabel="Inactivo"
                    trueLabel="Activo"
                />
            </InputContainer>

            <InputContainer labelName='Capacidad'>

                <NullableBooleanInput
                    source="capacity"
                    nullLabel=" "
                    falseLabel="Inactivo"
                    trueLabel="Activo"
                />
            </InputContainer>

            <InputContainer labelName='Puestos'>

                <NullableBooleanInput
                    source="stalls"
                    nullLabel=" "
                    falseLabel="Inactivo"
                    trueLabel="Activo"
                />
            </InputContainer>
        </BaseForm>
    )
}

VehicleParameterEdit.defaultProps = {
    basePath: '/vehicle-parameters',
    resource: 'vehicle-parameters'
}

export default VehicleParameterEdit
