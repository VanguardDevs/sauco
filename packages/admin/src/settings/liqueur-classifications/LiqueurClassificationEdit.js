import * as React from 'react'
import {
    useMutation,
    useEditController,
    useRedirect,
    useNotify
} from 'react-admin'
import { validateLiqueurClassification } from './liqueurclassificationValidations';
import BaseForm from '@sauco/lib/components/BaseForm'
import InputContainer from '@sauco/lib/components/InputContainer'
import { useParams } from 'react-router-dom'
import TextInput from '@sauco/lib/components/TextInput'

const LiqueurClassificationEdit = props => {
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
            notify(`¡Ha editado la clasificación "${data.name}" exitosamente!`, 'success')
            redirect('/liqueur-classifications')
        }
    }, [loaded])

    const { record } = editControllerProps

    return (
        <BaseForm
            save={save}
            validate={validateLiqueurClassification}
            record={record}
            saveButtonLabel='Actualizar'
            loading={loading}
            formName="Editar Clasificación"
        >
            <InputContainer labelName='Nombre'>
                <TextInput
                    name="name"
                    placeholder="Nombre"
                    fullWidth
                />
            </InputContainer>
            <InputContainer labelName='Abreviación'>
                <TextInput
                    name="abbreviature"
                    placeholder="Abreviación"
                    fullWidth
                />
            </InputContainer>
        </BaseForm>
    )
}

LiqueurClassificationEdit.defaultProps = {
    basePath: '/liqueur-classifications',
    resource: '/liqueur-classifications'
}

export default LiqueurClassificationEdit
