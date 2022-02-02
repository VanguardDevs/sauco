import {
    Create,
    SimpleForm,
    TextInput,
    CreateProps,
} from 'react-admin';
import InputContainer from '@sauco/common/components/InputContainer'
import validate from './validate'

const ItemCreate = (props: CreateProps) => (
    <Create title="Nuevo rubro" {...props}>
        <SimpleForm validate={validate} redirect='/items'>
            <InputContainer labelName='Nombre'>
                <TextInput
                    label={false}
                    source="name"
                    placeholder="Ej. Avenida Libertad #217"
                    fullWidth
                />
            </InputContainer>
        </SimpleForm>
    </Create>
);

export default ItemCreate;
