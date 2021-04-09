import * as React from "react";
// import { useDispatch } from 'react-redux';
// import { setDialog } from '../actions';
import {
  Filter,
  TextInput,
  DateInput,
  DateField,
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
    <TextInput label="year" source='year' />
    <DateInput source="gt_date" />
    <DateInput source="lt_date" />
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
      { 
        isSmall 
        ? (      
          <SimpleList
            primaryText={record => `${record.concept.name}`}
            secondaryText={record => `${record.amount}`}
            tertiaryText={record => `${record.year.name}`}
            linkType={"show"}
          />
        )
        : (
          <Datagrid>
            <TextField source="concept.name" label="Concepto"/>
            <TextField source="year.name" label="Año"/>
            <NumberField source='amount' label='Monto' />
            <NumberField source='liquidations_count' label='Liquidaciones' />
            <TextField source="payments_count" label="Facturas"/>
          </Datagrid>
        )
      }
    </List>
  );
};

export default MovementList;
