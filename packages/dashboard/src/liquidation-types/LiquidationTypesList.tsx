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

const ItemsFilter: React.FC = props => (
  <Filter {...props}>
    <TextInput label="Nombre" source='name' />
  </Filter>
);

const ItemsList: React.FC = props => {
  const isSmall = useMediaQuery<Theme>(theme => theme.breakpoints.down('sm'));

  return (
    <List {...props}
      title="Tipos de liquidaciones"
      bulkActionButtons={false}
      filters={<ItemsFilter />}
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
              <NumberField source="liquidations_count" label="Liquidaciones"/>
              <EditButton />
              <DeleteButton />
          </Datagrid>
        )
      }
    </List>
  );
};

export default ItemsList;
