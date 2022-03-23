import * as React from 'react'
import {
    useMutation,
    TextInput,
    useEditController,
    useRedirect,
    useNotify
} from 'react-admin'
import { validateColor } from './colorValidations';
import BaseForm from '@sauco/lib/components/BaseForm'
import InputContainer from '@sauco/lib/components/InputContainer'
import { useParams } from 'react-router-dom'

const ColorEdit = props => {
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
            notify(`¡Ha editado la categoría "${data.name}" exitosamente!`, 'success')
            redirect('/configurations?tab=categories')
        }
    }, [loaded])

    const { record } = editControllerProps

    return (
        <BaseForm
            save={save}
            validate={validateColor}
            record={record}
            saveButtonLabel='Actualizar'
            loading={loading}
            formName="Editar categoría"
        >
            <InputContainer labelName='Nombre'>
                <TextInput
                    source="name"
                    placeholder="Nombre"
                    fullWidth
                />
            </InputContainer>
        </BaseForm>
    )
}

ColorEdit.defaultProps = {
    basePath: '/configurations/categories',
    resource: 'configurations/categories'
}

export default ColorEdit
