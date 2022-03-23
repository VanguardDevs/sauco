import * as React from "react";
import {
    Filter,
    TextInput,
    List,
    Datagrid,
    TextField,
    SimpleList,
    BooleanInput,
    CreateButton,
    EditButton
} from 'react-admin';
import { Theme, useMediaQuery } from '@material-ui/core';
import { Actions } from '@sauco/common/components';

const TaxpayersFilter: React.FC = props => (
    <Filter {...props}>
        <TextInput label="Usuario" source='user' />
        <TextInput label="Decreto" source='decree' />
        <TextInput label="Título" source='title' />
        <BooleanInput label='Estado' source='status' />
    </Filter>
);

const ListActions: React.FC = props => (
    <Actions {...props}>
        <CreateButton />
    </Actions>
);

const TaxpayersList: React.FC = props => {
    const isSmall = useMediaQuery<Theme>(theme => theme.breakpoints.down('sm'));

    return (
        <List {...props}
            title="Contribuyentes"
            bulkActionButtons={false}
            filters={<TaxpayersFilter />}
            exporter={false}
            actions={<ListActions />}
        >
            {
                isSmall
                ? (
                    <SimpleList
                        primaryText={record => `${record.name}`}
                        secondaryText={record => `${record.decree}`}
                    />
                )
                : (
                    <Datagrid>
                        <TextField source="name" label="Nombre"/>
                        <TextField source="concepts_count" label="Decreto"/>
                        <EditButton />
                    </Datagrid>
                )
            }
        </List>
    );
};

export default TaxpayersList;
