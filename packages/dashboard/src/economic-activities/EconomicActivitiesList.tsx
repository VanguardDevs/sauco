import * as React from "react";
import {
    Filter,
    TextInput,
    List,
    Datagrid,
    NumberField,
    TextField,
    SimpleList,
    NumberInput,
    ReferenceArrayInput,
    SelectInput,
    BooleanInput
} from 'react-admin';
import { Actions } from '@sauco/common/components';
import { Theme, useMediaQuery } from '@material-ui/core';
import ExportButton from '../components/ExportButton'

const EconomicActivitiesListFilter: React.FC = props => (
    <Filter {...props}>
        <TextInput label="Nombre" source='name' />
        <TextInput label="Código" source='code' />
        <BooleanInput label="Activo" source='active' />
        <NumberInput label="Alícuota mayor que" source='gt_aliquote' />
        <NumberInput label="Alícuota menor que" source='lt_aliquote' />
        <NumberInput label="Mínimo tributable mayor que" source='gt_min_tax' />
        <NumberInput label="Mínimo tributable menor que" source='lt_min_tax' />
        <ReferenceArrayInput
            source="charging_method_id"
            reference="charging-methods"
            label="Método de cobro"
            allowEmpty={false}
        >
            <SelectInput
                source="name"
                label="Método de cobro"
            />
        </ReferenceArrayInput>
    </Filter>
);

const ListActions: React.FC = props => (
    <Actions {...props}>
        <ExportButton
            downloableName='actividades-economicas'
        />
    </Actions>
);

const EconomicActivitiesDatagrid = ({ isSmall }: any) => (
    <>
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
                    <TextField source="code" label="Código"/>
                    <TextField source="name" label="Nombre"/>
                    <TextField source="aliquote" label="Alícuota"/>
                    <TextField source="charging_method.name" label="Forma de cálculo"/>
                    <TextField source='min_tax' label='Mínimo tributable' />
                    <TextField source='taxpayers_count' label='Empresas' />
                </Datagrid>
            )
        }
    </>
)

const EconomicActivityList: React.FC = props => {
  const isSmall = useMediaQuery<Theme>(theme => theme.breakpoints.down('sm'));

    return (
        <List {...props}
            title="Actividades económicas"
            bulkActionButtons={false}
            filters={<EconomicActivitiesListFilter />}
            actions={<ListActions />}
        >
            <EconomicActivitiesDatagrid isSmall={isSmall} />
        </List>
    );
};

export default EconomicActivityList;
