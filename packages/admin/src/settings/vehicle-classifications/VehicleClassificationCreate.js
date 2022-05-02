import * as React from 'react'
import {
    NumberInput,
    useMutation,
    useRedirect,
    useNotify,
} from 'react-admin'
import { validateVehicleClassification } from './vehicleclassificationValidations';
import BaseForm from '@sauco/lib/components/BaseForm'
import InputContainer from '@sauco/lib/components/InputContainer'
import TextInput from '@sauco/lib/components/TextInput'

const VehicleClassificationCreate = props => {
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
            notify(`¡Ha registrado la clasificación "${data.name}!`, 'success');
            redirect('/vehicle-classifications')
        }
    }, [loaded])

    return (
        <BaseForm
            save={save}
            validate={validateVehicleClassification}
            loading={loading}
            formName='Agregar Clasificación de Vehiculo'
            unresponsive
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

VehicleClassificationCreate.defaultProps = {
    basePath: '/vehicle-classifications',
    resource: 'vehicle-classifications'
}

export default VehicleClassificationCreate;
