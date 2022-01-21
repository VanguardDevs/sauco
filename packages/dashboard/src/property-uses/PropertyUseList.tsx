import * as React from "react";
import {
  Filter,
  TextInput,
  List,
  Datagrid,
  EditButton,
  DeleteButton,
  TextField,
  SimpleList
} from 'react-admin';
import { Theme, useMediaQuery } from '@material-ui/core';

const PropertyUseFilter: React.FC = props => (
    <Filter {...props}>
        <TextInput label="Nombre" source='name' />
        <TextInput label="Valor" source='value' />
    </Filter>
);

const PropertyUseList: React.FC = props => {
    const isSmall = useMediaQuery<Theme>(theme => theme.breakpoints.down('sm'));

    return (
        <List {...props}
            title="Usos de inmuebles"
            bulkActionButtons={false}
            filters={<PropertyUseFilter />}
            exporter={false}
        >
        {
            isSmall
            ? (
            <SimpleList
                primaryText={record => `${record.description}`}
            />
            )
            : (
            <Datagrid>
                <TextField source="name" label="Nombre"/>
                <TextField source="value" label="Valor"/>
                <EditButton />
                <DeleteButton />
            </Datagrid>
            )
        }
        </List>
    );
};

export default PropertyUseList;
