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

const CorrelativeTypeDatagrid = () => (
    <Datagrid optimized>
        <TextField label='Descripción' source="description" />
        <DatagridOptions
            basePath='correlative-types'
            confirmTitle='Eliminar tipo de pago'
            confirmContent='¿Está seguro que desea eliminar este tipo de correlativo?'
        />
    </Datagrid>
);

const ListActions = () => (
    <TopToolbar>
        <FilterLiveSearch source="description" label='' />
        <CreateButton label="Crear" basePath="correlative-types" />
    </TopToolbar>
);

const CorrelativeTypeList = props => (
    <ListBase
        perPage={10}
        sort={{ field: 'created_at', order: 'ASC' }}
        {...props}
    >
        <DatagridListView actions={<ListActions />} datagrid={<CorrelativeTypeDatagrid />} />
    </ListBase>
);

CorrelativeTypeList.defaultProps = {
    basePath: 'correlative-types',
    resource: 'correlative-types'
}

export default CorrelativeTypeList
