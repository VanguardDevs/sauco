import * as React from 'react'
import {
    useMutation,
    useRedirect,
    useNotify,
} from 'react-admin'
import { validateLiqueurClassification } from './liqueurclassificationValidations';
import BaseForm from '@sauco/lib/components/BaseForm'
import InputContainer from '@sauco/lib/components/InputContainer'
import TextInput from '@sauco/lib/components/TextInput'

const LiqueurClassificationCreate = props => {
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
            redirect('/liqueur-classifications')
        }
    }, [loaded])

    return (
        <BaseForm
            save={save}
            validate={validateLiqueurClassification}
            loading={loading}
            formName='Agregar clasificatión'
            unresponsive
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

LiqueurClassificationCreate.defaultProps = {
    basePath: '/liqueur-classifications',
    resource: 'liqueur-classifications'
}

export default LiqueurClassificationCreate
