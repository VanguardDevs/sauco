import {
    Create,
    SimpleForm,
    TextInput,
    CreateProps,
} from 'react-admin';
import validate from './validateLiquidationTypes'

const LiquidationTypeCreate = (props: CreateProps) => (
    <Create {...props}>
        <SimpleForm validate={validate} redirect='/liquidation-types'>
            <TextInput
                label={false}
                source="name"
                placeholder="Ej. Avenida Libertad #217"
                fullWidth
            />
        </SimpleForm>
    </Create>
);

export default LiquidationTypeCreate;
