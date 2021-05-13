import * as React from "react";
import {
  Filter,
  TextInput,
  List,
  Datagrid,
  NumberField,
  TextField,
  SimpleList,
  ReferenceArrayInput,
  SelectInput,
  DateInput
} from 'react-admin';
import { Theme, useMediaQuery } from '@material-ui/core';

const optionRenderer = (choice:any) => `${choice.description}`;

const LicensesFilter: React.FC = props => (
  <Filter {...props}>
    <TextInput label="Número" source='num' />
    <TextInput label="Contribuyente" source='taxpayer' />
    <ReferenceArrayInput
      source="ordinance_id"
      reference="ordinances"
      label="Ordenanza"
    >
      <SelectInput
        source="description"
        label="Ordenanza"
        optionText={optionRenderer}
        allowEmpty={false}
      />
    </ReferenceArrayInput>
    <DateInput source="gt_date" label='Emitida después de' />
    <DateInput source="lt_date" label='Emitida antes de' />
  </Filter>
);

const LicensesList: React.FC = props => {
  const isSmall = useMediaQuery<Theme>(theme => theme.breakpoints.down('sm'));

  return (
    <List {...props}
      title="Sanciones"
      bulkActionButtons={false}
      filters={<LicensesFilter />}
      exporter={false}
    >
      {
        isSmall
        ? (
          <SimpleList
            primaryText={record => `${record.num}`}
            secondaryText={record => `${record.ordinance.description }`}
            tertiaryText={record => `${record.taxpayer.rif}`}
            linkType={"show"}
          />
        )
        : (
          <Datagrid>
            <TextField source="num" label="Número"/>
            <TextField source="ordinance.description" label="Ordenanza"/>
            <TextField source="taxpayer.name" label="Contribuyente"/>
          </Datagrid>
        )
      }
    </List>
  );
};

export default LicensesList;
