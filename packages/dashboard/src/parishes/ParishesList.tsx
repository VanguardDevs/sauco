import * as React from "react";
import {
  Filter,
  TextInput,
  List,
  Datagrid,
  TextField,
  SimpleList,
  EditButton,
  DeleteButton
} from 'react-admin';
import { Theme, useMediaQuery } from '@material-ui/core';

const PermissionsFilter: React.FC = props => (
  <Filter {...props}>
    <TextInput label="Nombre" source='name' />
  </Filter>
);

const PermissionsList: React.FC = props => {
  const isSmall = useMediaQuery<Theme>(theme => theme.breakpoints.down('sm'));

  return (
    <List {...props}
      title="Estados"
      bulkActionButtons={false}
      filters={<PermissionsFilter />}
      exporter={false}
    >
      {
        isSmall
        ? (
          <SimpleList
            primaryText={record => `${record.name}`}
            secondaryText={record => `${record.code}`}
          />
        )
        : (
          <Datagrid>
            <TextField source="name" label="Nombre"/>
            <TextField source="code" label="Código"/>
            <EditButton />
            <DeleteButton />
          </Datagrid>
        )
      }
    </List>
  );
};

export default PermissionsList;
