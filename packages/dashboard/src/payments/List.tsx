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
  ReferenceField,
  ReferenceArrayInput,
  SelectInput
} from 'react-admin';
import { Actions } from '@sauco/common/components';
import { Theme, useMediaQuery } from '@material-ui/core';
import DownloadButton from '../components/DownloadButton'

const optionRenderer = (choice:any) => `${choice.description}`;

const PaymentsFilter: React.FC = props => (
  <Filter {...props}>
    <TextInput label="Número" source='num' />
    <TextInput label="RIF" source='rif' />
    <TextInput label="Nombre" source='taxpayer' />
    <TextInput label="Monto" source='amount' />
    <DateInput source="gt_date" label='Procesado después de' />
    <DateInput source="lt_date" label='Procesado antes de' />
    <ReferenceArrayInput
      source="payment_type_id"
      reference="payment-types"
      label="Tipo de pago"
    >
      <SelectInput
        source="description"
        label="Tipo de pago"
        optionText={optionRenderer}
        allowEmpty={false}
      />
    </ReferenceArrayInput>
    <ReferenceArrayInput
      source="payment_method_id"
      reference="payment-methods"
      label="Método de pago"
    >
      <SelectInput source="description" label="Método de pago" allowEmpty={false} />
    </ReferenceArrayInput>
  </Filter>
);

const ListActions: React.FC = props => (
    <Actions {...props}>
        <DownloadButton />
    </Actions>
);

const PaymentsList: React.FC = props => {
  const isSmall = useMediaQuery<Theme>(theme => theme.breakpoints.down('sm'));

  return (
        <List {...props}
            title="Facturas"
            filters={<PaymentsFilter />}
            actions={<ListActions />}
        >
        {
            isSmall
            ? (
                <SimpleList
                    primaryText={record => `${record.num}`}
                    secondaryText={record => `${record.processed_at}`}
                    tertiaryText={record => `${record.pretty_amount}`}
                    linkType={"show"}
                />
            )
            : (
                <Datagrid>
                    <TextField source="num" label="Número"/>
                    <ReferenceField
                    label="Contribuyente"
                    source="taxpayer_id"
                    reference="taxpayers"
                    link="show"
                    >
                    <TextField source="name" />
                    </ReferenceField>
                    <NumberField source='amount' label='Monto' />
                </Datagrid>
            )
        }
        </List>
  );
};

export default PaymentsList;
