import * as React from 'react'
import {
    useMutation,
    NumberInput,
    useEditController,
    useRedirect,
    useNotify
} from 'react-admin'
import { validateVehicleClassification } from './vehicleclassificationValidations';
import BaseForm from '@sauco/lib/components/BaseForm'
import InputContainer from '@sauco/lib/components/InputContainer'
import { useParams } from 'react-router-dom'
import TextInput from '@sauco/lib/components/TextInput'

const VehicleClassificationEdit = props => {
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
            redirect('/vehicle-classifications')
        }
    }, [loaded])

    const { record } = editControllerProps

    return (
        <BaseForm
            save={save}
            validate={validateVehicleClassification}
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

            <InputContainer labelName='Cantidad'>
                <NumberInput source="quantity" />
            </InputContainer>

            <InputContainer labelName='Peso desde'>
                <NumberInput source="weight_from" />
            </InputContainer>

            <InputContainer labelName='Peso hasta'>
                <NumberInput source="weight_until" />
            </InputContainer>

            <InputContainer labelName='Capacidad desde'>
                <NumberInput source="capacity_from" />
            </InputContainer>

            <InputContainer labelName='Capacidad hasta'>
                <NumberInput source="capacity_until" />
            </InputContainer>

            <InputContainer labelName='Puestos desde'>
                <NumberInput source="stalls_from" />
            </InputContainer>

            <InputContainer labelName='Puestos hasta'>
                <NumberInput source="stalls_until" />
            </InputContainer>
        </BaseForm>
    )
}

VehicleClassificationEdit.defaultProps = {
    basePath: '/vehicle-classifications',
    resource: 'vehicle-classifications'
}

export default VehicleClassificationEdit
