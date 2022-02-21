import * as React from "react";
import {
  Filter,
  TextInput,
  List,
  Datagrid,
  TextField,
  SimpleList,
  EditButton
} from 'react-admin';
import { Theme, useMediaQuery } from '@material-ui/core';

const UsersFilter: React.FC = props => (
  <Filter {...props}>
    <TextInput label="Login" source='login' />
    <TextInput label="Nombre" source='full_name' />
  </Filter>
);

const ItemsList: React.FC = props => {
  const isSmall = useMediaQuery<Theme>(theme => theme.breakpoints.down('sm'));

  return (
    <List {...props}
      title="Usuarios"
      bulkActionButtons={false}
      filters={<UsersFilter />}
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
              <TextField source="full_name" label="Nombre"/>
              <TextField source="login" label="Usuario"/>
              <EditButton />
          </Datagrid>
        )
      }
    </List>
  );
};

export default ItemsList;
