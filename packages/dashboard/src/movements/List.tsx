import * as React from "react";
import {
  Filter,
  TextInput,
  DateInput,
  List,
  Datagrid,
  NumberField,
  TextField,
  useRecordContext
} from 'react-admin';
import numeral from 'numeral';
import { MovementTypeField } from '@sauco/common/components';
import { Theme, useMediaQuery } from '@material-ui/core';

const CustomAmountField = (props: any) => {
    const record = useRecordContext(props);
    const amount = numeral(record.amount).format('0,0.00');

    return <span>{amount}</span>;
}

const MovementFilter: React.FC = props => (
  <Filter {...props}>
    <TextInput label="Concepto" source='concept' />
    <DateInput source="gt_date" label='Procesado después de' />
    <DateInput source="lt_date" label='Procesado antes de' />
  </Filter>
);

const MovementList: React.FC = props => {
  const isSmall = useMediaQuery<Theme>(theme => theme.breakpoints.down('sm'));

  return (
    <List {...props}
      title="Movimientos"
      bulkActionButtons={false}
      filters={<MovementFilter />}
      exporter={false}
    >
      <Datagrid>
        <TextField source="name" label="Concepto"/>
        <CustomAmountField label="Monto" />
        <MovementTypeField label="Tipo de movimiento" />
        <NumberField source='movements_count' label='Movimientos' />
      </Datagrid>
    </List>
  );
};

CustomAmountField.defaultProps = {
    label: 'Monto',
    addLabel: true
}

export default MovementList;
