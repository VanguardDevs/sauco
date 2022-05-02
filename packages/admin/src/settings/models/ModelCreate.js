import * as React from 'react'
import {
    ReferenceInput,
    SelectInput,
    useMutation,
    useRedirect,
    useNotify,
} from 'react-admin'
import { validateModel } from './modelValidations';
import BaseForm from '@sauco/lib/components/BaseForm'
import InputContainer from '@sauco/lib/components/InputContainer'
import TextInput from '@sauco/lib/components/TextInput'

const ModelCreate = props => {
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
    }, [])

    React.useEffect(() => {
        if (loaded) {
            notify(`¡Ha registrado el modelo "${data.name}!`, 'success');
            redirect('/models')
        }
    }, [loaded])

    return (
        <BaseForm
            save={save}
            validate={validateModel}
            loading={loading}
            formName='Agregar modelo'
            unresponsive
        >
            <InputContainer labelName='Nombre'>
                <TextInput
                    name="name"
                    placeholder="Nombre"
                    fullWidth
                />
            </InputContainer>

            <InputContainer labelName='Marca'>
                <ReferenceInput source="brand_id" reference="brands" >
                    <SelectInput optionText="name" optionValue="id" />
                </ReferenceInput>
            </InputContainer>
        </BaseForm>
    )
}

ModelCreate.defaultProps = {
    basePath: '/models',
    resource: 'models'
}

export default ModelCreate
