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

const LiqueurParametersDatagrid = () => (
    <Datagrid optimized>
        <TextField label='Nombre' source="name" />
        <DatagridOptions
            basePath='liqueur-parameters'
            confirmTitle='Eliminar clasificación'
            confirmContent='¿Está seguro que desea eliminar esta clasificación?'
        />
    </Datagrid>
);

const ListActions = () => (
    <TopToolbar>
        <FilterLiveSearch source="name" label='' />
        <CreateButton label="Crear" basePath="/liqueur-parameters" />
    </TopToolbar>
);

const LiqueurParameterList = props => (
    <ListBase
        perPage={10}
        sort={{ field: 'created_at', order: 'ASC' }}
        {...props}
    >
        <DatagridListView actions={<ListActions />} datagrid={<LiqueurParametersDatagrid />} />
    </ListBase>
);

LiqueurParameterList.defaultProps = {
    basePath: '/liqueur-parameters',
    resource: '/liqueur-parameters'
}

export default LiqueurParameterList
