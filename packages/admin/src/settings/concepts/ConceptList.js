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

const ConceptDatagrid = () => (
    <Datagrid optimized>
        <TextField label='Código' source="code" />
        <TextField label='Nombre' source="name" />
        <DatagridOptions
            basePath='concepts'
            confirmTitle='Eliminar Concepto'
            confirmContent='¿Está seguro que desea eliminar este concepto?'
        />
    </Datagrid>
);

const ListActions = () => (
    <TopToolbar>
        <FilterLiveSearch source="name" label='' />
        <CreateButton label="Crear" basePath="concepts" />
    </TopToolbar>
);

const ConceptList = props => (
    <ListBase
        perPage={10}
        sort={{ field: 'created_at', order: 'ASC' }}
        {...props}
    >
        <DatagridListView actions={<ListActions />} datagrid={<ConceptDatagrid />} />
    </ListBase>
);

ConceptList.defaultProps = {
    basePath: 'concepts',
    resource: 'concepts'
}

export default ConceptList
