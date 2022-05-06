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

const ModelsDatagrid = () => (
    <Datagrid optimized>
        <TextField label='Nombre' source="name" />
        <DatagridOptions
            basePath='vehicle-models'
            confirmTitle='Eliminar modelo'
            confirmContent='¿Está seguro que desea eliminar este modelo?'
        />
    </Datagrid>
);

const ListActions = () => (
    <TopToolbar>
        <FilterLiveSearch source="name" label='' />
        <CreateButton label="Crear" basePath="/vehicle-models" />
    </TopToolbar>
);

const ModelList = props => (
    <ListBase
        perPage={10}
        sort={{ field: 'created_at', order: 'ASC' }}
        {...props}
    >
        <DatagridListView actions={<ListActions />} datagrid={<ModelsDatagrid />} />
    </ListBase>
);

ModelList.defaultProps = {
    basePath: 'vehicle-models',
    resource: 'vehicle-models'
}

export default ModelList
