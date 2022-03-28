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

const VehicleParametersDatagrid = () => (
    <Datagrid optimized>
        <TextField label='Nombre' source="name" />
        <DatagridOptions
            basePath='vehicle-parameters'
            confirmTitle='Eliminar parametro'
            confirmContent='¿Está seguro que desea eliminar este parametro?'
        />
    </Datagrid>
);

const ListActions = () => (
    <TopToolbar>
        <FilterLiveSearch source="name" label='' />
        <CreateButton label="Crear" basePath="/vehicle-parameters" />
    </TopToolbar>
);

const VehicleParameterList = props => (
    <ListBase
        perPage={10}
        sort={{ field: 'created_at', order: 'ASC' }}
        {...props}
    >
        <DatagridListView actions={<ListActions />} datagrid={<VehicleParametersDatagrid />} />
    </ListBase>
);

VehicleParameterList.defaultProps = {
    basePath: 'vehicle-parameters',
    resource: 'vehicle-parameters'
}

export default VehicleParameterList
