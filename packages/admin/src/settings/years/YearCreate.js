import * as React from 'react'
import {
    useMutation,
    useRedirect,
    useNotify,
} from 'react-admin'
import { validateYear } from './yearValidations';
import BaseForm from '@sauco/lib/components/BaseForm'
import InputContainer from '@sauco/lib/components/InputContainer'
import TextInput from '@sauco/lib/components/TextInput'

const YearCreate = props => {
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
            notify(`¡Ha registrado el año "${data.year}!`, 'success');
            redirect('/years')
        }
    }, [loaded])

    return (
        <BaseForm
            save={save}
            validate={validateYear}
            loading={loading}
            formName='Agregar Año'
            unresponsive
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

YearCreate.defaultProps = {
    basePath: '/years',
    resource: 'years'
}

export default YearCreate
