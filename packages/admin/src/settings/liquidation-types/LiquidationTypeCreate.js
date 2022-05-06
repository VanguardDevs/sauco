import * as React from 'react'
import {
    useMutation,
    useRedirect,
    useNotify,
} from 'react-admin'
import { validateLiquidationType } from './liquidationTypeValidations';
import BaseForm from '@sauco/lib/components/BaseForm'
import InputContainer from '@sauco/lib/components/InputContainer'
import TextInput from '@sauco/lib/components/TextInput'

const LiquidationTypeCreate = props => {
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
            notify(`¡Ha registrado el tipo de liquidación "${data.name}!`, 'success');
            redirect('/liquidation-types')
        }
    }, [loaded])

    return (
        <BaseForm
            save={save}
            validate={validateLiquidationType}
            loading={loading}
            formName='Agregar Tipo de Liquidación'
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

LiquidationTypeCreate.defaultProps = {
    basePath: 'liquidation-types',
    resource: 'liquidation-types'
}

export default LiquidationTypeCreate
