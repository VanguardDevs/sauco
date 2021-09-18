import * as React from "react";
import {
  Filter,
  TextInput,
  List,
  Datagrid,
  TextField,
  SimpleList,
  ReferenceArrayInput,
  SelectInput,
  TopToolbar,
  CreateButton
} from 'react-admin';
import { Theme, useMediaQuery } from '@material-ui/core';

const optionRenderer = (choice:any) => `${choice.description}`;

const TaxpayersFilter: React.FC = props => (
  <Filter {...props}>
    <TextInput label="RIF" source='rif' />
    <TextInput label="Nombre" source='name' />
    <TextInput label="Teléfono" source='phone' />
    <TextInput label="Correo" source='email' />
    <TextInput label="Dirección" source='address' />
    <ReferenceArrayInput
      source="taxpayer_type_id"
      reference="taxpayer-types"
      label="Tipo de contribuyente"
    >
      <SelectInput
        source="description"
        label="Tipo de contribuyente"
        optionText={optionRenderer}
        allowEmpty={false}
      />
    </ReferenceArrayInput>
    <ReferenceArrayInput
      source="taxpayer_classification_id"
      reference="taxpayer-classifications"
      label="Clasificación"
    >
      <SelectInput source="name" label="Clasificación" allowEmpty={false} />
    </ReferenceArrayInput>
  </Filter>
);

const ListActions = () => (
    <TopToolbar>
        <CreateButton basePath="/taxpayers" />
    </TopToolbar>
);

const TaxpayersList: React.FC = props => {
  const isSmall = useMediaQuery<Theme>(theme => theme.breakpoints.down('sm'));

  return (
    <List {...props}
      title="Contribuyentes"
      bulkActionButtons={false}
      filters={<TaxpayersFilter />}
      exporter={false}
      actions={<ListActions />}
    >
      {
        isSmall
        ? (
          <SimpleList
            primaryText={record => `${record.name}`}
            secondaryText={record => `${record.rif}`}
            tertiaryText={record => `${record.address}`}
            linkType={"show"}
          />
        )
        : (
          <Datagrid>
            <TextField source="rif" label="RIF"/>
            <TextField source="name" label="Nombre"/>
            <TextField source="address" label="Dirección"/>
          </Datagrid>
        )
      }
    </List>
  );
};

export default TaxpayersList;
