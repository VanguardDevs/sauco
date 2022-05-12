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

const ChargingMethodDatagrid = () => (
    <Datagrid optimized>
        <TextField label='Nombre' source="name" />
        <DatagridOptions
            basePath='charging-methods'
            confirmTitle='Eliminar Método de Pago'
            confirmContent='¿Está seguro que desea eliminar este método de pago?'
        />
    </Datagrid>
);

const ListActions = () => (
    <TopToolbar>
        <FilterLiveSearch source="name" label='' />
        <CreateButton label="Crear" basePath="charging-methods" />
    </TopToolbar>
);

const ChargingMethodList = props => (
    <ListBase
        perPage={10}
        sort={{ field: 'created_at', order: 'ASC' }}
        {...props}
    >
        <DatagridListView actions={<ListActions />} datagrid={<ChargingMethodDatagrid />} />
    </ListBase>
);

ChargingMethodList.defaultProps = {
    basePath: 'charging-methods',
    resource: 'charging-methods'
}

export default ChargingMethodList
