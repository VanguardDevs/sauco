import * as React from 'react';
import {
    ShowProps,
    SimpleShowLayout,
    Show,
    TextField,
} from 'react-admin';

const CancellationShow: React.FC<ShowProps> = props => (
    <Show {...props}>
        <SimpleShowLayout>
            <TextField source="reason" label="Razón de anulación" />
            <TextField source="type.name" label="Tipo de anulación" />
            <TextField source="user.full_name" label="Usuario" />
            <TextField source="created_at" label="Fecha de anulación" />
            <TextField source="type.name" label="Tipo de anulación" />
            <TextField source="cancellable.num" label="Nro. del movimiento cancelado" />
        </SimpleShowLayout>
    </Show>
);

export default CancellationShow;
