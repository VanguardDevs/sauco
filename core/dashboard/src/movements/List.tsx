import * as React from "react";
// import { useDispatch } from 'react-redux';
// import { setDialog } from '../actions';
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

const MovementFilter: React.FC = props => (
  <Filter {...props}>
    <TextInput label="Concepto" source='concept' />
    <TextInput label="Año" source='year' />
    <DateInput source="gt_date" label='Procesado después de' />
    <DateInput source="lt_date" label='Procesado antes de' />
  </Filter>
);

const MovementList: React.FC = props => {
  const isSmall = useMediaQuery<Theme>(theme => theme.breakpoints.down('sm'));
  // const dispatch = useDispatch();

  // const handleClick = () => dispatch(setDialog());

  return (
    <List {...props}
      title="Movimientos"
      bulkActionButtons={false}
      filters={<MovementFilter />}
      exporter={false}
    >
      <Datagrid>
        <TextField source="name" label="Concepto"/>
        <TextField source="year" label="Año"/>
        <NumberField source='amount' label='Monto' />
        <NumberField source='liquidations_count' label='Liquidaciones' />
        <NumberField source="payments_count" label="Facturas"/>
      </Datagrid>
    </List>
  );
};

export default MovementList;
