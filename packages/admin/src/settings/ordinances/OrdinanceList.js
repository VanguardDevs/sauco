import {
    Datagrid,
    TextField,
    ListBase,
    FilterLiveSearch,
    TopToolbar
} from 'react-admin'
import DatagridOptions from '@sauco/lib/components/DatagridOptions';
import CreateButton from '@sauco/lib/components/CreateButton'
import DatagridListView from '@sauco/lib/components/DatagridListView'

const OrdinancesDatagrid = () => (
    <Datagrid optimized>
        <TextField label='Descripción' source="description" />
        <DatagridOptions
            basePath='ordinances'
            confirmTitle='Eliminar Ordenanza'
            confirmContent='¿Está seguro que desea eliminar este color?'
        />
    </Datagrid>
);

const ListActions = () => (
    <TopToolbar>
        <FilterLiveSearch source="description" label='' />
        <CreateButton label="Crear" basePath="ordinances" />
    </TopToolbar>
);

const OrdinanceList = props => (
    <ListBase
        perPage={10}
        sort={{ field: 'created_at', order: 'ASC' }}
        {...props}
    >
        <DatagridListView actions={<ListActions />} datagrid={<OrdinancesDatagrid />} />
    </ListBase>
);

OrdinanceList.defaultProps = {
    basePath: 'ordinances',
    resource: 'ordinances'
}

export default OrdinanceList
