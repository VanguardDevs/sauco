import * as React from "react";
import {
  Filter,
  TextInput,
  List,
  Datagrid,
  NumberField,
  TextField,
  SimpleList
} from 'react-admin';
import { Theme, useMediaQuery } from '@material-ui/core';

const UsersFilter: React.FC = props => (
  <Filter {...props}>
    <TextInput label="Nombre" source='description' />
  </Filter>
);

const UsersList: React.FC = props => {
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
            primaryText={record => `${record.login}`}
          />
        )
        : (
          <Datagrid>
            <TextField source="login" label="Login"/>
          </Datagrid>
        )
      }
    </List>
  );
};

export default UsersList;
