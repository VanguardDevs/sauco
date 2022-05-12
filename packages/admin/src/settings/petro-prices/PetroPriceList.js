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

const PetroPricesDatagrid = () => (
    <Datagrid optimized>
        <TextField label='Valor' source="value" />
        <DatagridOptions
            basePath='petro-prices'
            confirmTitle='Eliminar Valor'
            confirmContent='¿Está seguro que desea eliminar este valor?'
        />
    </Datagrid>
);

const ListActions = () => (
    <TopToolbar>
        <FilterLiveSearch source="value" label='' />
        <CreateButton label="Crear" basePath="petro-prices" />
    </TopToolbar>
);

const PetroPriceList = props => (
    <ListBase
        perPage={10}
        sort={{ field: 'created_at', order: 'ASC' }}
        {...props}
    >
        <DatagridListView actions={<ListActions />} datagrid={<PetroPricesDatagrid />} />
    </ListBase>
);

PetroPriceList.defaultProps = {
    basePath: 'petro-prices',
    resource: 'petro-prices'
}

export default PetroPriceList
