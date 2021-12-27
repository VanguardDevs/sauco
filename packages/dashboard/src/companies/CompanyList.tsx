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
    ShowButton
} from 'react-admin';
import { Theme, useMediaQuery } from '@material-ui/core';
import ExportButton from '../components/ExportButton'
import { Actions, RecordActions } from '@sauco/common/components';

const optionRenderer = (choice:any) => `${choice.description}`;

const CompaniesFilter: React.FC = props => (
    <Filter {...props}>
        <TextInput label="RIF" source='rif' />
        <TextInput label="Nombre" source='name' />
        <TextInput label="Teléfono" source='phone' />
        <TextInput label="Correo" source='email' />
        <TextInput label="Dirección" source='address' />
        <ReferenceArrayInput
            source="parish_id"
            reference="parishes"
            label="Parroquia"
        >
            <SelectInput
                source="description"
                label="Parroquia"
                optionText={optionRenderer}
                allowEmpty={false}
            />
        </ReferenceArrayInput>
        <ReferenceArrayInput
            source="community_id"
            reference="communities"
            label="Comunidad"
        >
            <SelectInput source="name" label="Comunidad" allowEmpty={false} />
        </ReferenceArrayInput>
    </Filter>
);

const ListActions: React.FC = props => (
    <Actions {...props}>
        <ExportButton downloableName='empresas' />
    </Actions>
);

const CompaniesList: React.FC = props => {
    const isSmall = useMediaQuery<Theme>(theme => theme.breakpoints.down('sm'));

    return (
        <List {...props}
            title="Empresas"
            bulkActionButtons={false}
            filters={<CompaniesFilter />}
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
                        <RecordActions>
                            <ShowButton />
                        </RecordActions>
                    </Datagrid>
                )
            }
        </List>
    );
};

export default CompaniesList;
