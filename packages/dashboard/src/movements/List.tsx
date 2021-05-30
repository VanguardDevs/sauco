import * as React from "react";
import {
  Filter,
  TextInput,
  DateInput,
  List,
  Datagrid,
  NumberField,
  TextField
} from 'react-admin';
import { MovementTypeField } from '@sauco/common/components';
import { Theme, useMediaQuery } from '@material-ui/core';

const MovementFilter: React.FC = props => (
  <Filter {...props}>
    <TextInput label="Concepto" source='concept' />
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
        <NumberField source='amount' label='Monto' options={{ style: 'currency', currency: 'USD' }}/>
        <MovementTypeField label="Tipo de movimiento" />
        <NumberField source='movements_count' label='Movimientos' />
      </Datagrid>
    </List>
  );
};

export default MovementList;
