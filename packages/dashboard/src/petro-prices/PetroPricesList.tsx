import * as React from "react";
import {
  Filter,
  DateInput,
  List,
  Datagrid,
  NumberField,
  SimpleList,
  DateField
} from 'react-admin';
import { Theme, useMediaQuery } from '@material-ui/core';

const optionRenderer = (choice:any) => `${choice.description}`;

const PetroPricesFilter: React.FC = props => (
  <Filter {...props}>
    <DateInput source="gt_date" label='Después de' />
    <DateInput source="lt_date" label='Antes de' />
  </Filter>
);

const PetroPricesList: React.FC = props => {
  const isSmall = useMediaQuery<Theme>(theme => theme.breakpoints.down('sm'));

  return (
    <List {...props}
      title="Cotizaciones del petro"
      bulkActionButtons={false}
      filters={<PetroPricesFilter />}
      exporter={false}
    >
      {
        isSmall
        ? (
          <SimpleList
            primaryText={record => `${record.created_at}`}
            secondaryText={record => `${record.value}`}
            linkType={"show"}
          />
        )
        : (
          <Datagrid>
              <DateField source="created_at" label="Fecha" showTime />
              <NumberField source="value" label="Valor" options={{ style: 'currency', currency: 'VES' }} />
          </Datagrid>
        )
      }
    </List>
  );
};

export default PetroPricesList;
