import * as React from "react";
import {
    Filter,
    TextInput,
    Datagrid,
    TextField,
    ListBase,
    BooleanInput,
    BooleanField,
    CreateButton,
    EditButton,
    FilterLiveSearch,
    TopToolbar
} from 'react-admin';
import DatagridListView from '@sauco/lib/components/DatagridListView'

const CategoriesDatagrid = () => (
    <Datagrid optimized>
        <TextField source="title" label="Título"/>
        <TextField source="decree" label="Decreto"/>
        <BooleanField source="active" label="Estado"/>
        <EditButton />
    </Datagrid>
);

const TaxpayersFilter = props => (
    <Filter {...props}>
        <TextInput label="Usuario" source='user' />
        <TextInput label="Decreto" source='decree' />
        <TextInput label="Título" source='title' />
        <BooleanInput label='Estado' source='status' />
    </Filter>
);

const ListActions = () => (
    <TopToolbar>
        <FilterLiveSearch source="name" label='' />
        <CreateButton label="Crear" basePath="signatures" />
    </TopToolbar>
);

const TaxpayersList = props => (
    <ListBase
        perPage={10}
        sort={{ field: 'created_at', order: 'ASC' }}
        {...props}
    >
        <DatagridListView actions={<ListActions />} datagrid={<CategoriesDatagrid />} />
    </ListBase>
);

export default TaxpayersList;
