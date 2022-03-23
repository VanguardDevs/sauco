import * as React from "react";
import {
  Filter,
  TextInput,
  List,
  Datagrid,
  TextField,
  SimpleList,
  EditButton,
  DeleteButton,
  ReferenceField,
  ReferenceArrayInput,
  SelectInput
} from 'react-admin';
import { Theme, useMediaQuery } from '@material-ui/core';

const PermissionsFilter: React.FC = props => (
  <Filter {...props}>
    <TextInput label="Nombre" source='name' />
    <TextInput label="Código" source='code' />
    <ReferenceArrayInput source="state_id" reference="states" label="Estado">
      <SelectInput source="name" label="Estado" allowEmpty={false} />
    </ReferenceArrayInput>
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
            <ReferenceField
              label="Estado"
              source="state_id"
              reference="states"
              link="show"
            >
              <TextField source="name" />
            </ReferenceField>
            <EditButton />
            <DeleteButton />
          </Datagrid>
        )
      }
    </List>
  );
};

export default PermissionsList;
