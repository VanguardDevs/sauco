import * as React from 'react'
import {
    NullableBooleanInput,
    useMutation,
    useRedirect,
    useNotify,
} from 'react-admin'
import { validateVehicleParameter } from './vehicleparameterValidations';
import BaseForm from '@sauco/lib/components/BaseForm'
import InputContainer from '@sauco/lib/components/InputContainer'
import TextInput from '@sauco/lib/components/TextInput'

const VehicleParameterCreate = props => {
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
            redirect('/vehicle-parameters')
        }
    }, [loaded])

    return (
        <BaseForm
            save={save}
            validate={validateVehicleParameter}
            loading={loading}
            formName='Agregar Parametro de Vehiculo'
            unresponsive
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

VehicleParameterCreate.defaultProps = {
    basePath: '/vehicle-parameters',
    resource: 'vehicle-parameters'
}

export default VehicleParameterCreate;
