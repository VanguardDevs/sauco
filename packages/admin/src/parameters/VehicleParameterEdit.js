import * as React from 'react'
import {
    useMutation,
    TextInput,
    SelectInput,
    useEditController,
    useRedirect,
    useNotify
} from 'react-admin'
import { validateVehicleParameter } from './vehicleparameterValidations';
import BaseForm from '@sauco/lib/components/BaseForm'
import InputContainer from '@sauco/lib/components/InputContainer'
import { useParams } from 'react-router-dom'

const options = [
    { id: 0, name: "Activo" },
    { id: 1, name: "Inactivo" }
]

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

VehicleParameterEdit.defaultProps = {
    basePath: '/vehicle-parameters',
    resource: 'vehicle-parameters'
}

export default VehicleParameterEdit
