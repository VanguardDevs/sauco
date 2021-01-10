import * as React from 'react';
import { FC } from 'react';
import {
  Datagrid,
  TextField,
  List
} from 'react-admin';

const UserList: FC = props => {
  return (
    <List {...props} title="Lista de usuarios">
      <Datagrid>
        <TextField source='id' />
        <TextField source='login' />
      </Datagrid>
    </List>
  )
}

export default UserList;