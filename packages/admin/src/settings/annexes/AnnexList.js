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

const AnnexesDatagrid = () => (
    <Datagrid optimized>
        <TextField label='Nombre' source="name" />
        <DatagridOptions
            basePath='liqueur-annexes'
            confirmTitle='Eliminar anexo'
            confirmContent='¿Está seguro que desea eliminar este anexo?'
        />
    </Datagrid>
);

const ListActions = () => (
    <TopToolbar>
        <FilterLiveSearch source="name" label='' />
        <CreateButton label="Crear" basePath="liqueur-annexes" />
    </TopToolbar>
);

const AnnexList = props => (
    <ListBase
        perPage={10}
        sort={{ field: 'created_at', order: 'ASC' }}
        {...props}
    >
        <DatagridListView actions={<ListActions />} datagrid={<AnnexesDatagrid />} />
    </ListBase>
);

AnnexList.defaultProps = {
    basePath: 'liqueur-annexes',
    resource: 'liqueur-annexes'
}

export default AnnexList
