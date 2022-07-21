import * as React from 'react'
import Box from '@mui/material/Box'
import TextField from '@mui/material/TextField'
import SearchIcon from '@mui/icons-material/Search';
import { useMediaQuery } from '@mui/material'
import useFetch from '../../hooks/useFetch'
import Table from '../../components/Table'
import ButtonLink from '../../components/ButtonLink'
import ListContainer from '../../components/ListContainer';
import LinkIconButton from '../../components/LinkIconButton';
import TableCell from '@mui/material/TableCell';
import TableRow from '@mui/material/TableRow';
import DeleteButton from '../../components/DeleteButton'
import { useSnackbar } from 'notistack';
import axios from '../../api'
import RemoveRedEyeIcon from '@mui/icons-material/RemoveRedEye';
import PrintButton from '../../components/DownloadButton';
import { useAdmin } from '../../context/AdminContext'

const headCells = [
    { 
        id: 'name',
        numeric: false,
        disablePadding: true,
        label: 'Nombre',
    },
    { 
        id: 'cubicles',
        numeric: false,
        disablePadding: true,
        label: 'Nº de cubículos',
        align: 'center'
    },
    { 
        id: 'actions',
        numeric: false,
        disablePadding: true,
        label: 'Acciones',
        align: 'center'
    }
];

const ItemList = () => {
    const { state: { perPage, page } } = useAdmin()
    const isSmall = useMediaQuery(theme =>
        theme.breakpoints.down('sm')
    )
    const [filter, setFilter] = React.useState({})
    const { loading, total, data } = useFetch('/items', {
        perPage: perPage,
        page: page,
        filter: filter
    })
    const [items, setItems] = React.useState({})
    const { enqueueSnackbar } = useSnackbar();

    const handleOnChange = (e) => {
        if (e.currentTarget.value) {
            setFilter({
                name: e.currentTarget.value
            })
        } else {
            setFilter({})
        }
    }

    const handleDelete = React.useCallback(async (values) => {
        const { data } = await axios.delete(`/items/${values.id}`);

        if (data) {
            setItems(prevItems => [...prevItems.filter(({ id }) => id != data.id)])
            enqueueSnackbar(
                `¡Ha eliminado el rubro "${data.name}"`, 
                { variant: 'success' }
            );
        }
    }, [])

    const rowRender = () => (
        items.map(row => (
            <TableRow hover tabIndex={-1} key={row.name}>
                <TableCell
                    component="th"
                    id={`${row.id}`}
                    scope="row"
                    padding="normal"
                    width='70%'
                >
                    {row.name}
                </TableCell>
                <TableCell
                    component="th"
                    id={`${row.id}`}
                    scope="row"
                    padding="normal"
                    align='center'
                    width='20%'
                >
                    {row.cubicles_count}
                </TableCell>
                <TableCell scope="row" align='right' width='10%'>
                    <Box sx={{ display: 'flex', justifyContent: 'center' }}>
                        <LinkIconButton
                            href={`/items/${row.id}`} 
                            icon={<RemoveRedEyeIcon />}
                        />
                        <LinkIconButton href={`/items/${row.id}/edit`} />
                        <DeleteButton
                            title={`¿Está seguro que desea eliminar el rubro "${row.name}"?`}
                            onClick={() => handleDelete(row)}
                        />
                    </Box>
                </TableCell>
            </TableRow>
        )))

    React.useEffect(() => setItems(data), [data])

    return (
        <ListContainer title="Rubros">
            <Box sx={{ display: 'flex', justifyContent: 'space-between' }}>
                <Box width={isSmall ? '100%' : '40%'} backgroundColor='#fff'>
                    <TextField
                        onChange={handleOnChange}
                        InputProps={{
                            startAdornment: (
                                <Box marginLeft='6px' display='flex'>
                                    <SearchIcon />
                                </Box>
                            )
                        }}
                        placeholder='Buscar'
                        fullWidth
                    />
                </Box>
                <Box sx={{
                    display: 'flex',
                    height: '2rem',
                    width: '8rem',
                    justifyContent: 'space-between',
                }}>
                    {items.length ? (
                        <PrintButton
                            perPage={10}
                            filter={filter}
                            basePath='/items'
                            filename='rubros.pdf'
                            type='pdf'
                        />
                    ) : <></>}
                    <ButtonLink
                        color="primary"
                        variant="contained"
                        to="/items/create"
                    />
                </Box>
            </Box>
            <Box>
                <Table
                    headCells={headCells}
                    rows={items.length && rowRender()}
                    loading={loading}
                    total={total}
                />
            </Box>
        </ListContainer>
    )
}

export default ItemList
