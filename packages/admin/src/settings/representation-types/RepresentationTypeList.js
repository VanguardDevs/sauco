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

const RepresentationTypeDatagrid = () => (
    <Datagrid optimized>
        <TextField label='Nombre' source="name" />
        <DatagridOptions
            basePath='representation-types'
            confirmTitle='Eliminar tipo de representante'
            confirmContent='¿Está seguro que desea eliminar este tipo de representante?'
        />
    </Datagrid>
);

const ListActions = () => (
    <TopToolbar>
        <FilterLiveSearch source="name" label='' />
        <CreateButton label="Crear" basePath="representation-types" />
    </TopToolbar>
);

const RepresentationTypeList = props => (
    <ListBase
        perPage={10}
        sort={{ field: 'created_at', order: 'ASC' }}
        {...props}
    >
        <DatagridListView actions={<ListActions />} datagrid={<RepresentationTypeDatagrid />} />
    </ListBase>
);

RepresentationTypeList.defaultProps = {
    basePath: 'representation-types',
    resource: 'representation-types'
}

export default RepresentationTypeList
