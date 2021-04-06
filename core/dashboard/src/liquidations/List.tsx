import * as React from "react";
// import { useDispatch } from 'react-redux';
// import { setDialog } from '../actions';
import {
  Filter,
  TextInput,
  DateField,
  List, 
  Datagrid,
  NumberField,
  TextField,
  SimpleList,
} from 'react-admin';
import { Theme, useMediaQuery } from '@material-ui/core';

const StudentFilter: React.FC = props => (
  <Filter {...props}>
    <TextInput label="Número" source='num' />
    <TextInput label="Objeto de pago" source='object_payment' />
    <TextInput label="Contribuyente" source='taxpayer' />
    <TextInput label="Monto" source='amount' />
  </Filter>
);

const StudentList: React.FC = props => {
  const isSmall = useMediaQuery<Theme>(theme => theme.breakpoints.down('sm'));
  // const dispatch = useDispatch();

  // const handleClick = () => dispatch(setDialog());

  return (
    <List {...props}
      title="Liquidaciones"
      bulkActionButtons={false}
      filters={<StudentFilter />}
      exporter={false}
    >
      { 
        isSmall 
        ? (      
          <SimpleList
            primaryText={record => `${record.num}`}
            secondaryText={record => `${record.object_payment}`}
            linkType={"show"}
          />
        )
        : (
          <Datagrid>
            <TextField source="num" label="Número"/>
            <TextField source="object_payment" label="Objeto de pago"/>
            <NumberField source='amount' label='Monto' />
            <TextField source="taxpayer.name" label="Contribuyente"/>
            <TextField source="liquidation_type.name" label="Tipo"/>
          </Datagrid>
        )
      }
    </List>
  );
};

export default StudentList;
