import * as React from 'react'
import {
    TextInput,
    SelectInput,
    useMutation,
    useRedirect,
    useNotify,
} from 'react-admin'
import { validateVehicleParameter } from './vehicleparameterValidations';
import BaseForm from '@sauco/lib/components/BaseForm'
import InputContainer from '@sauco/lib/components/InputContainer'

const options = [
    { id: 0, name: "Activo" },
    { id: 1, name: "Inactivo" }
]

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
                    source="name"
                    placeholder="Nombre"
                    fullWidth
                />
            </InputContainer>

            <InputContainer labelName='Años'>
            <SelectInput source="years" choices={options} />
            </InputContainer>
            <InputContainer labelName='Peso'>
            <SelectInput  source="weight" choices={options} />
            </InputContainer>
            <InputContainer labelName='Capacidad'>
            <SelectInput  source="capacity" choices={options} />
            </InputContainer>
            <InputContainer labelName='Puestos'>
            <SelectInput  source="stalls" choices={options} />
            </InputContainer>
        </BaseForm>
    )
}

VehicleParameterCreate.defaultProps = {
    basePath: '/vehicle-parameters',
    resource: 'vehicle-parameters'
}

export default VehicleParameterCreate;
