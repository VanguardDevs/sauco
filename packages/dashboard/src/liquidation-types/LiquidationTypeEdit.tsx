import {
    Edit,
    SimpleForm,
    TextInput,
    EditProps,
} from 'react-admin';
import validate from './validateLiquidationTypes'

const LiquidationTypeEdit = (props: EditProps) => (
    <Edit {...props}>
        <SimpleForm validate={validate}>
            <TextInput
                label={false}
                source="name"
                placeholder="Ej. Avenida Libertad #217"
                fullWidth
            />
        </SimpleForm>
    </Edit>
);

export default LiquidationTypeEdit;
