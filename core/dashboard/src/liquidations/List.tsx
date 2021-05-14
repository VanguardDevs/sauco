import * as React from "react";
import {
  Filter,
  TextInput,
  List,
  Datagrid,
  NumberField,
  TextField,
  SimpleList,
  ReferenceField,
  ReferenceArrayInput,
  SelectInput
} from 'react-admin';
import { Theme, useMediaQuery } from '@material-ui/core';

const StudentFilter: React.FC = props => (
  <Filter {...props}>
    <TextInput label="Número" source='num' />
    <TextInput label="Objeto de pago" source='object_payment' />
    <TextInput label="Contribuyente" source='taxpayer' />
    <TextInput label="Monto" source='amount' />
    <ReferenceArrayInput source="status_id" reference="status" label="Estado">
      <SelectInput source="name" label="Estado" allowEmpty={false} />
    </ReferenceArrayInput>
    <ReferenceArrayInput source="liquidation_type_id" reference="liquidation-types" label="Tipo">
      <SelectInput source="name" label="Tipo" allowEmpty={false} />
    </ReferenceArrayInput>
  </Filter>
);

const StudentList: React.FC = props => {
  const isSmall = useMediaQuery<Theme>(theme => theme.breakpoints.down('sm'));

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
            <ReferenceField label="Contribuyente" source="taxpayer_id" reference="taxpayers">
                <TextField source="name" />
            </ReferenceField>
            <TextField source="liquidation_type.name" label="Tipo"/>
          </Datagrid>
        )
      }
    </List>
  );
};

export default StudentList;
