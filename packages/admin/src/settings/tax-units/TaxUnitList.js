import {
    Datagrid,
    TextField,
    ListBase,
    FilterLiveSearch,
    TopToolbar
} from 'react-admin'
import DatagridListView from '@sauco/lib/components/DatagridListView'

const TaxUnitDatagrid = () => (
    <Datagrid optimized>
        <TextField label='Ley' source="law" />
        <TextField label='Valor' source="value" />
        <TextField label='Fecha de Publicación' source="publication_date" />
    </Datagrid>
);

const ListActions = () => (
    <TopToolbar>
        <FilterLiveSearch source="law" label='' />
    </TopToolbar>
);

const TaxUnitList = props => (
    <ListBase
        perPage={10}
        sort={{ field: 'created_at', order: 'ASC' }}
        {...props}
    >
        <DatagridListView actions={<ListActions />} datagrid={<TaxUnitDatagrid />} />
    </ListBase>
);

TaxUnitList.defaultProps = {
    basePath: 'tax-units',
    resource: 'tax-units'
}

export default TaxUnitList
