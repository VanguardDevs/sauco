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
    DateInput,
    BooleanInput
} from 'react-admin';
import { Theme, useMediaQuery } from '@material-ui/core';
import { Actions } from '@sauco/common/components';
import ExportButton from '../components/ExportButton'

const optionRenderer = (choice:any) => `${choice.description}`;

const LICENSE_TYPES = [
    { id: 'R-', name: 'Renovada' },
    { id: 'I-', name: 'Nueva' }
]

const LicensesFilter: React.FC = props => (
    <Filter {...props}>
        <TextInput label="Número" source='num' />
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
        <SelectInput
            source="type"
            label="Tipo"
            choices={LICENSE_TYPES}
            allowEmpty={false}
        />
        <TextInput label="Razón social" source='taxpayer' />
        <BooleanInput label="Estado" source="active" />
    </Filter>
);

const ListActions: React.FC = props => (
    <Actions {...props}>
        <ExportButton downloableName='licencias' />
    </Actions>
);

const LicensesList: React.FC = props => {
    const isSmall = useMediaQuery<Theme>(theme => theme.breakpoints.down('sm'));

    return (
        <List {...props}
            title="Licencias"
            bulkActionButtons={false}
            filters={<LicensesFilter />}
            actions={<ListActions {...props} />}
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
                    <ReferenceField label="Contribuyente" source="taxpayer_id" reference="taxpayers" link='show'>
                        <TextField source="name" />
                    </ReferenceField>
                    <TextField source="emission_date" label="Emisión"/>
                </Datagrid>
            )
        }
        </List>
    );
};

export default LicensesList;
