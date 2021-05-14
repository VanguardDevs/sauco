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
  ReferenceField,
  DateInput
} from 'react-admin';
import { Theme, useMediaQuery } from '@material-ui/core';

const ApplicationsFilter: React.FC = props => (
  <Filter {...props}>
    <TextInput label="Número" source='num' />
    <TextInput label="Contribuyente" source='taxpayer' />
    <TextInput label="Monto" source='amount' />
    <ReferenceArrayInput
        source="concept_id"
        reference="concepts"
        label="Rubro"
        filter={{ 'liquidation_type_id': 1 }}
    >
      <SelectInput source="name" label="Tipo" allowEmpty={false} />
    </ReferenceArrayInput>
    <DateInput source="gt_date" label='Realizado después de' />
    <DateInput source="lt_date" label='Realizado antes de' />
  </Filter>
);

const ApplicationsList: React.FC = props => {
  const isSmall = useMediaQuery<Theme>(theme => theme.breakpoints.down('sm'));

  return (
    <List {...props}
      title="Solicitudes"
      bulkActionButtons={false}
      filters={<ApplicationsFilter />}
      exporter={false}
    >
      {
        isSmall
        ? (
          <SimpleList
            primaryText={record => `${record.num}`}
            secondaryText={record => `${record.concept.name}`}
            tertiaryText={record => `${record.taxpayer.rif}`}
            linkType={"show"}
          />
        )
        : (
          <Datagrid>
            <TextField source="num" label="Número"/>
            <TextField source="concept.name" label="Rubro"/>
            <NumberField source='amount' label='Monto' />
            <ReferenceField label="Contribuyente" source="taxpayer_id" reference="taxpayers">
                <TextField source="name" />
            </ReferenceField>
          </Datagrid>
        )
      }
    </List>
  );
};

export default ApplicationsList;
