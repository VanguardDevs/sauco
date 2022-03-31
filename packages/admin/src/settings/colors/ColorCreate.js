import * as React from 'react'
import {
    TextInput,
    useMutation,
    useRedirect,
    useNotify,
} from 'react-admin'
import { validateColor } from './colorValidations';
import BaseForm from '@sauco/lib/components/BaseForm'
import InputContainer from '@sauco/lib/components/InputContainer'

const ColorCreate = props => {
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
            notify(`¡Ha registrado el color "${data.name}!`, 'success');
            redirect('/colors')
        }
    }, [loaded])

    return (
        <BaseForm
            save={save}
            validate={validateColor}
            loading={loading}
            formName='Agregar color'
            unresponsive
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

ColorCreate.defaultProps = {
    basePath: 'colors',
    resource: 'colors'
}

export default ColorCreate
