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

const IntervalDatagrid = () => (
    <Datagrid optimized>
        <TextField label='Nombre' source="name" />
        <DatagridOptions
            basePath='intervals'
            confirmTitle='Eliminar Intervalo'
            confirmContent='¿Está seguro que desea eliminar este intervalo?'
        />
    </Datagrid>
);

const ListActions = () => (
    <TopToolbar>
        <FilterLiveSearch source="name" label='' />
        <CreateButton label="Crear" basePath="intervals" />
    </TopToolbar>
);

const IntervalList = props => (
    <ListBase
        perPage={10}
        sort={{ field: 'created_at', order: 'ASC' }}
        {...props}
    >
        <DatagridListView actions={<ListActions />} datagrid={<IntervalDatagrid />} />
    </ListBase>
);

IntervalList.defaultProps = {
    basePath: 'intervals',
    resource: 'intervals'
}

export default IntervalList
