import * as React from 'react'
import {
    useMutation,
    useRedirect,
    useNotify,
} from 'react-admin'
import { validateAnnex } from './annexValidations';
import BaseForm from '@sauco/lib/components/BaseForm'
import InputContainer from '@sauco/lib/components/InputContainer'
import TextInput from '@sauco/lib/components/TextInput'

const AnnexCreate = props => {
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
            notify(`¡Ha registrado el anexo "${data.name}!`, 'success');
            redirect('/liqueur-annexes')
        }
    }, [loaded])

    return (
        <BaseForm
            save={save}
            validate={validateAnnex}
            loading={loading}
            formName='Agregar anexo'
            unresponsive
        >
            <InputContainer labelName='Nombre'>
                <TextInput
                    name="name"
                    placeholder="Nombre"
                    fullWidth
                />
            </InputContainer>
        </BaseForm>
    )
}

AnnexCreate.defaultProps = {
    basePath: '/liqueur-annexes',
    resource: 'liqueur-annexes'
}

export default AnnexCreate
