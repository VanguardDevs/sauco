import * as React from 'react'
import {
    TextInput,
    useMutation,
    useRedirect,
    useNotify,
} from 'react-admin'
import { validateZone } from './zoneValidations';
import BaseForm from '@sauco/lib/components/BaseForm'
import InputContainer from '@sauco/lib/components/InputContainer'

const ZoneCreate = props => {
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
            notify(`¡Ha registrado la zona "${data.name}!`, 'success');
            redirect('/liqueur-zones')
        }
    }, [loaded])

    return (
        <BaseForm
            save={save}
            validate={validateZone}
            loading={loading}
            formName='Agregar zona'
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

ZoneCreate.defaultProps = {
    basePath: '/liqueur-zones',
    resource: 'liqueur-zones'
}

export default ZoneCreate
