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

const LiquidationTypeDatagrid = () => (
    <Datagrid optimized>
        <TextField label='Nombre' source="name" />
        <DatagridOptions
            basePath='liquidation-types'
            confirmTitle='Eliminar tipo de liquidación'
            confirmContent='¿Está seguro que desea eliminar este tipo de liquidación?'
        />
    </Datagrid>
);

const ListActions = () => (
    <TopToolbar>
        <FilterLiveSearch source="name" label='' />
        <CreateButton label="Crear" basePath="liquidation-types" />
    </TopToolbar>
);

const LiquidationTypeList = props => (
    <ListBase
        perPage={10}
        sort={{ field: 'created_at', order: 'ASC' }}
        {...props}
    >
        <DatagridListView actions={<ListActions />} datagrid={<LiquidationTypeDatagrid />} />
    </ListBase>
);

LiquidationTypeList.defaultProps = {
    basePath: 'liquidation-types',
    resource: 'liquidation-types'
}

export default LiquidationTypeList
