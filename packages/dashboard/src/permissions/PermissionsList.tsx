import * as React from "react";
import {
  Filter,
  TextInput,
  List,
  Datagrid,
  NumberField,
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
      title="Permisos de usuario"
      bulkActionButtons={false}
      filters={<PermissionsFilter />}
      exporter={false}
    >
      {
        isSmall
        ? (
          <SimpleList
            primaryText={record => `${record.name}`}
          />
        )
        : (
          <Datagrid>
            <TextField source="name" label="Nombre"/>
            <EditButton />
            <DeleteButton />
          </Datagrid>
        )
      }
    </List>
  );
};

export default PermissionsList;
