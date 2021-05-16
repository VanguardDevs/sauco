import * as React from "react";
import {
  Filter,
  TextInput,
  List,
  Datagrid,
  ReferenceField,
  TextField,
  SimpleList,
  ReferenceArrayInput,
  SelectInput,
  DateInput
} from 'react-admin';
import { Theme, useMediaQuery } from '@material-ui/core';
import { format, subDays, addDays, parse } from 'date-fns';

const optionRenderer = (choice:any) => `${choice.description}`;

const LicensesFilter: React.FC = props => (
  <Filter {...props}>
    <TextInput label="Número" source='num' />
    <ReferenceField
      label="Contribuyente"
      source="taxpayer_id"
      reference="taxpayers"
      link="show"
    >
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
      title="Licencias"
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
            <ReferenceField label="Contribuyente" source="taxpayer_id" reference="taxpayers">
                <TextField source="name" />
            </ReferenceField>
          </Datagrid>
        )
      }
    </List>
  );
};

export default LicensesList;
