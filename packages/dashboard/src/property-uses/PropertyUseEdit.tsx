import {
    Edit,
    SimpleForm,
    TextInput,
    EditProps,
} from 'react-admin';
import validatePropertyUse from './validatePropertUse'

const PropertyUseEdit = (props: EditProps) => (
    <Edit {...props}>
        <SimpleForm validate={validatePropertyUse} redirect='/ordinances'>
            <TextInput
                label={false}
                source="description"
                fullWidth
            />
        </SimpleForm>
    </Edit>
);

export default PropertyUseEdit;
