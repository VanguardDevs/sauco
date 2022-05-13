import {
    Datagrid,
    TextField,
    BooleanField,
    ListBase,
    FilterLiveSearch,
    TopToolbar
} from 'react-admin'
import DatagridOptions from '@sauco/lib/components/DatagridOptions';
import CreateButton from '@sauco/lib/components/CreateButton'
import DatagridListView from '@sauco/lib/components/DatagridListView'

const SignatureDatagrid = () => (
    <Datagrid optimized>
        <TextField source="title" label="Título"/>
        <TextField source="decree" label="Decreto"/>
        <BooleanField source="active" label="Estado"/>
        <DatagridOptions
            basePath='signatures'
            confirmTitle='Eliminar Firma'
            confirmContent='¿Está seguro que desea eliminar esta firma?'
        />
    </Datagrid>
);

const ListActions = () => (
    <TopToolbar>
        <FilterLiveSearch source="title" label='' />
        <CreateButton label="Crear" basePath="signatures" />
    </TopToolbar>
);

const SignatureList = props => (
    <ListBase
        perPage={10}
        sort={{ field: 'created_at', order: 'ASC' }}
        {...props}
    >
        <DatagridListView actions={<ListActions />} datagrid={<SignatureDatagrid />} />
    </ListBase>
);

SignatureList.defaultProps = {
    basePath: 'signatures',
    resource: 'signatures'
}

export default SignatureList
