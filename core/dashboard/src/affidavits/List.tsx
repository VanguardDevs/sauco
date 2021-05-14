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
  ReferenceField
} from 'react-admin';
import { Theme, useMediaQuery } from '@material-ui/core';

const AffidavitsFilter: React.FC = props => (
  <Filter {...props}>
    <TextInput label="Número" source='num' />
    <TextInput label="RIF" source='rif' />
    <TextInput label="Nombre" source='taxpayer' />
    <TextInput label="Monto bruto" source='total_brute_amount' />
    <TextInput label="Monto calculado" source='total_calc_amount' />
    <DateInput source="gt_date" label='Recibido después de' />
    <DateInput source="lt_date" label='Recibido antes de' />
  </Filter>
);

const AffidavitsList: React.FC = props => {
  const isSmall = useMediaQuery<Theme>(theme => theme.breakpoints.down('sm'));
  // const dispatch = useDispatch();

  // const handleClick = () => dispatch(setDialog());

  return (
    <List {...props}
      title="Declaraciones"
      bulkActionButtons={false}
      filters={<AffidavitsFilter />}
      exporter={false}
    >
      {
        isSmall
        ? (
          <SimpleList
            primaryText={record => `${record.num}`}
            secondaryText={record => `${record.taxpayer.name}`}
            tertiaryText={record => `${record.total_calc_amount}`}
            linkType={"show"}
          />
        )
        : (
          <Datagrid>
            <TextField source="num" label="Número"/>
            <ReferenceField label="Contribuyente" source="taxpayer_id" reference="taxpayers">
                <TextField source="name" />
            </ReferenceField>
            <NumberField source='total_brute_amount' label='Monto bruto' />
            <NumberField source='total_calc_amount' label='Monto calculado' />
            <TextField source="month.name" label="Mes" />
            <TextField source="month.year.year" label="Año" />
          </Datagrid>
        )
      }
    </List>
  );
};

export default AffidavitsList;
