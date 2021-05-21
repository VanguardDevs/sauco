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

const EconomicActivitiesListFilter: React.FC = props => (
  <Filter {...props}>
    <TextInput label="Nombre" source='name' />
  </Filter>
);

const EconomicActivitiesListList: React.FC = props => {
  const isSmall = useMediaQuery<Theme>(theme => theme.breakpoints.down('sm'));

  return (
    <List {...props}
      title="Actividades económicas"
      bulkActionButtons={false}
      filters={<EconomicActivitiesListFilter />}
      exporter={false}
    >
      {
        isSmall
        ? (
          <SimpleList
            primaryText={record => `${record.name}`}
            secondaryText={record => `${record.min_tax }`}
            tertiaryText={record => `${record.aliquote}`}
            linkType={"show"}
          />
        )
        : (
          <Datagrid>
            <TextField source="name" label="Nombre"/>
            <TextField source="aliquote" label="Alícuota"/>
            <NumberField source='min_tax' label='Mínimo tributable' />
          </Datagrid>
        )
      }
    </List>
  );
};

export default EconomicActivitiesListList;
