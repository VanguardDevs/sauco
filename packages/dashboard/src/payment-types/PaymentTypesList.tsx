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

const PaymentTypesFilter: React.FC = props => (
  <Filter {...props}>
    <TextInput label="Nombre" source='description' />
  </Filter>
);

const PaymentTypesList: React.FC = props => {
  const isSmall = useMediaQuery<Theme>(theme => theme.breakpoints.down('sm'));

  return (
    <List {...props}
      title="Tipos de pago"
      bulkActionButtons={false}
      filters={<PaymentTypesFilter />}
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
            <TextField source="description" label="Nombre"/>
            <NumberField source="payments_count" label="Facturas"/>
            <EditButton />
            <DeleteButton />
          </Datagrid>
        )
      }
    </List>
  );
};

export default PaymentTypesList;
