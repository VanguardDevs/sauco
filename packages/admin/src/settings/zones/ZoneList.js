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

const ZonesDatagrid = () => (
    <Datagrid optimized>
        <TextField label='Nombre' source="name" />
        <DatagridOptions
            basePath='liqueur-zones'
            confirmTitle='Eliminar zona'
            confirmContent='¿Está seguro que desea eliminar esta zona?'
        />
    </Datagrid>
);

const ListActions = () => (
    <TopToolbar>
        <FilterLiveSearch source="name" label='' />
        <CreateButton label="Crear" basePath="/liqueur-zones" />
    </TopToolbar>
);

const ZoneList = props => (
    <ListBase
        perPage={10}
        sort={{ field: 'created_at', order: 'ASC' }}
        {...props}
    >
        <DatagridListView actions={<ListActions />} datagrid={<ZonesDatagrid />} />
    </ListBase>
);

ZoneList.defaultProps = {
    basePath: '/liqueur-zones',
    resource: '/liqueur-zones'
}

export default ZoneList
