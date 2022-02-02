import {
    Edit,
    SimpleForm,
    TextInput,
    EditProps,
} from 'react-admin';
import InputContainer from '@sauco/common/components/InputContainer'
import validate from './validate'

const ItemsEdit = (props: EditProps) => (
    <Edit title="Editar rubro" {...props}>
        <SimpleForm validate={validate}>
            <InputContainer labelName='Nombre'>
                <TextInput
                    label={false}
                    source="name"
                    placeholder="Ej. Avenida Libertad #217"
                    fullWidth
                />
            </InputContainer>
        </SimpleForm>
    </Edit>
);

export default ItemsEdit;
