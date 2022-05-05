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

const YearsDatagrid = () => (
    <Datagrid optimized>
        <TextField label='Año' source="year" />
        <DatagridOptions
            basePath='years'
            confirmTitle='Eliminar año'
            confirmContent='¿Está seguro que desea eliminar este año?'
        />
    </Datagrid>
);

const ListActions = () => (
    <TopToolbar>
        <FilterLiveSearch source="year" label='' />
        <CreateButton label="Crear" basePath="years" />
    </TopToolbar>
);

const YearList = props => (
    <ListBase
        perPage={10}
        sort={{ field: 'created_at', order: 'ASC' }}
        {...props}
    >
        <DatagridListView actions={<ListActions />} datagrid={<YearsDatagrid />} />
    </ListBase>
);

YearList.defaultProps = {
    basePath: 'years',
    resource: 'years'
}

export default YearList
