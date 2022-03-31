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

const CategoriesDatagrid = () => (
    <Datagrid optimized>
        <TextField label='Nombre' source="name" />
        <DatagridOptions
            basePath='colors'
            confirmTitle='Eliminar categoría'
            confirmContent='¿Está seguro que desea eliminar esta categoría?'
        />
    </Datagrid>
);

const ListActions = () => (
    <TopToolbar>
        <FilterLiveSearch source="name" label='' />
        <CreateButton label="Crear" basePath="colors" />
    </TopToolbar>
);

const CategoryList = props => (
    <ListBase
        perPage={10}
        sort={{ field: 'created_at', order: 'ASC' }}
        {...props}
    >
        <DatagridListView actions={<ListActions />} datagrid={<CategoriesDatagrid />} />
    </ListBase>
);

CategoryList.defaultProps = {
    basePath: 'colors',
    resource: 'colors'
}

export default CategoryList
