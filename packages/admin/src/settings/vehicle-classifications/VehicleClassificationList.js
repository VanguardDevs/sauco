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

const VehicleClassificationsDatagrid = () => (
    <Datagrid optimized>
        <TextField label='Nombre' source="name" />
        <DatagridOptions
            basePath='vehicle-classifications'
            confirmTitle='Eliminar clasificación'
            confirmContent='¿Está seguro que desea eliminar esta clasificación?'
        />
    </Datagrid>
);

const ListActions = () => (
    <TopToolbar>
        <FilterLiveSearch source="name" label='' />
        <CreateButton label="Crear" basePath="/vehicle-classifications" />
    </TopToolbar>
);

const VehicleClassificationList = props => (
    <ListBase
        perPage={10}
        sort={{ field: 'created_at', order: 'ASC' }}
        {...props}
    >
        <DatagridListView actions={<ListActions />} datagrid={<VehicleClassificationsDatagrid />} />
    </ListBase>
);

VehicleClassificationList.defaultProps = {
    basePath: 'vehicle-classifications',
    resource: 'vehicle-classifications'
}

export default VehicleClassificationList
