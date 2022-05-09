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

const PaymentTypeDatagrid = () => (
    <Datagrid optimized>
        <TextField label='Descripción' source="description" />
        <DatagridOptions
            basePath='payment-types'
            confirmTitle='Eliminar tipo de pago'
            confirmContent='¿Está seguro que desea eliminar este tipo de pago?'
        />
    </Datagrid>
);

const ListActions = () => (
    <TopToolbar>
        <FilterLiveSearch source="name" label='' />
        <CreateButton label="Crear" basePath="payment-types" />
    </TopToolbar>
);

const PaymentTypeList = props => (
    <ListBase
        perPage={10}
        sort={{ field: 'created_at', order: 'ASC' }}
        {...props}
    >
        <DatagridListView actions={<ListActions />} datagrid={<PaymentTypeDatagrid />} />
    </ListBase>
);

PaymentTypeList.defaultProps = {
    basePath: 'payment-types',
    resource: 'payment-types'
}

export default PaymentTypeList
