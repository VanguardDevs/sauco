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

const PaymentMethodsFilter: React.FC = props => (
  <Filter {...props}>
    <TextInput label="Nombre" source='name' />
  </Filter>
);

const PaymentMethodsList: React.FC = props => {
  const isSmall = useMediaQuery<Theme>(theme => theme.breakpoints.down('sm'));

  return (
    <List {...props}
      title="Métodos de pago"
      bulkActionButtons={false}
      filters={<PaymentMethodsFilter />}
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
            <NumberField source="payments_count" label="Facturas"/>
          </Datagrid>
        )
      }
    </List>
  );
};

export default PaymentMethodsList;
