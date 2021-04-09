import * as React from "react";
import {
  Filter,
  TextInput,
  DateInput,
  List, 
  Datagrid,
  NumberField,
  TextField,
  SimpleList,
} from 'react-admin';
import { Theme, useMediaQuery } from '@material-ui/core';

const PaymentsFilter: React.FC = props => (
  <Filter {...props}>
    <TextInput label="Número" source='num' />
    <TextInput label="RIF" source='rif' />
    <TextInput label="Nombre" source='taxpayer' />
    <TextInput label="Monto" source='amount' />
    <DateInput source="gt_date" label='Procesado después de' />
    <DateInput source="lt_date" label='Procesado antes de' />
  </Filter>
);

const PaymentsList: React.FC = props => {
  const isSmall = useMediaQuery<Theme>(theme => theme.breakpoints.down('sm'));
  // const dispatch = useDispatch();

  // const handleClick = () => dispatch(setDialog());

  return (
    <List {...props}
      title="Facturas"
      bulkActionButtons={false}
      filters={<PaymentsFilter />}
      exporter={false}
    >
      { 
        isSmall 
        ? (      
          <SimpleList
            primaryText={record => `${record.num}`}
            secondaryText={record => `${record.taxpayer.name}`}
            tertiaryText={record => `${record.pretty_amount}`}
            linkType={"show"}
          />
        )
        : (
          <Datagrid>
            <TextField source="num" label="Número"/>
            <TextField source="taxpayer.rif" label="RIF"/>
            <TextField source="taxpayer.name" label="Nombre"/>
            <NumberField source='amount' label='Monto' />
          </Datagrid>
        )
      }
    </List>
  );
};

export default PaymentsList;
