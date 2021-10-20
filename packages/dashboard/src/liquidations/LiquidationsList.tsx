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
  SelectInput,
  DateInput
} from 'react-admin';
import { Actions } from '@sauco/common/components';
import { Theme, useMediaQuery } from '@material-ui/core';
import DownloadButton from '../components/DownloadButton'

const ListActions: React.FC = props => (
    <Actions {...props}>
        <DownloadButton />
    </Actions>
);

const LiquidationFilter: React.FC = props => (
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
        <DateInput source="gt_date" label='Procesado después de' />
        <DateInput source="lt_date" label='Procesado antes de' />
    </Filter>
);

const LiquidationsDatagrid = ({ isSmall }: any) => (
    <>
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
                    <ReferenceField
                        label="Contribuyente"
                        source="taxpayer_id"
                        reference="taxpayers"
                        link="show"
                    >
                        <TextField source="name" />
                    </ReferenceField>
                    <NumberField source='amount' label='Monto' />
                    <TextField source="liquidation_type.name" label="Tipo"/>
                </Datagrid>
            )
        }
    </>
)

const LiquidationList: React.FC = props => {
  const isSmall = useMediaQuery<Theme>(theme => theme.breakpoints.down('sm'));

    return (
        <List {...props}
            title="Liquidaciones"
            filters={<LiquidationFilter />}
            actions={<ListActions />}
            bulkActionButtons={false}
        >
            <LiquidationsDatagrid isSmall={isSmall} />
        </List>
    );
};

export default LiquidationList;
