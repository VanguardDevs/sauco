import * as React from 'react'
import { validateLiquidationType } from './liquidationTypeValidations';
import BaseForm from '@sauco/lib/components/BaseForm'
import InputContainer from '@sauco/lib/components/InputContainer'
import { useParams } from 'react-router-dom'
import TextInput from '@sauco/lib/components/TextInput'
import { axios, history } from '@sauco/lib/providers'


const LiquidationTypeEdit = props => {
    const { id } = useParams();
    const [loading, setLoading] = React.useState(false)
    const [loaded, setLoaded] = React.useState(false)
    const [record, setRecord] = React.useState(null)

    const save = React.useCallback(async (values) => {
        setLoading(true)
        try {
            const { data } = await axios.put(`/liquidation-types/${id}`, values)

            if (data) {
                setLoaded(true)
            }
        } catch (error) {
            if (error.response.data.errors) {
                return error.response.data.errors;
            }
        }
        setLoading(false)
    }, [id])


    const fetchRecord = React.useCallback(async () => {
        const { data } = await axios.get(`/liquidation-types/${id}`);

        setRecord(data);
    }, []);

    React.useEffect(() => {
        if (loaded) {
            history.push('/liquidation-types')
        }
    }, [loaded])

    React.useEffect(() => {
        fetchRecord()
    }, [])

    return (
        <BaseForm
            save={save}
            validate={validateLiquidationType}
            record={record}
            saveButtonLabel='Actualizar'
            loading={loading}
            formName="Editar el Tipo de Liquidación"
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

LiquidationTypeEdit.defaultProps = {
    basePath: 'liquidation-types',
    resource: 'liquidation-types'
}

export default LiquidationTypeEdit
