import * as React from 'react'
import {
    useMutation,
    useEditController,
    useRedirect,
    useNotify
} from 'react-admin'
import { validateYear } from './yearValidations';
import BaseForm from '@sauco/lib/components/BaseForm'
import InputContainer from '@sauco/lib/components/InputContainer'
import { useParams } from 'react-router-dom'
import TextInput from '@sauco/lib/components/TextInput'

const YearEdit = props => {
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
            notify(`¡Ha editado el año "${data.year}" exitosamente!`, 'success')
            redirect('/years')
        }
    }, [loaded])

    const { record } = editControllerProps

    return (
        <BaseForm
            save={save}
            validate={validateYear}
            record={record}
            saveButtonLabel='Actualizar'
            loading={loading}
            formName="Editar año"
        >
            <InputContainer labelName='Año'>
                <TextInput
                    name="year"
                    placeholder="Año"
                    fullWidth
                />
            </InputContainer>
        </BaseForm>
    )
}

YearEdit.defaultProps = {
    basePath: 'years',
    resource: 'years'
}

export default YearEdit
