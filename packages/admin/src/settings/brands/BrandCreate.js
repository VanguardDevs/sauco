import * as React from 'react'
import {
    useMutation,
    useRedirect,
    useNotify,
} from 'react-admin'
import { validateBrand } from './brandValidations';
import BaseForm from '@sauco/lib/components/BaseForm'
import InputContainer from '@sauco/lib/components/InputContainer'
import TextInput from '@sauco/lib/components/TextInput'

const BrandCreate = props => {
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
            notify(`¡Ha registrado la categoría "${data.name}!`, 'success');
            redirect('/brands')
        }
    }, [loaded])

    return (
        <BaseForm
            save={save}
            validate={validateBrand}
            loading={loading}
            formName='Agregar marca'
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

BrandCreate.defaultProps = {
    basePath: '/brands',
    resource: 'brands'
}

export default BrandCreate
