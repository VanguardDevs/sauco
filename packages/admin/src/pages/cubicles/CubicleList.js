import * as React from 'react'
import Box from '@mui/material/Box'
import TextField from '@mui/material/TextField'
import SearchIcon from '@mui/icons-material/Search';
import { Grid, useMediaQuery } from '@mui/material'
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
import PrintButton from '../../components/DownloadButton';
import Autocomplete from '@mui/material/Autocomplete';
import { useAdmin } from '../../context/AdminContext'

const options = [
    { 'label': 'Activo', value: 1 },
    { 'label': 'Inactivo', value: 0 }
]

const headCells = [
    { 
        id: 'address',
        numeric: false,
        disablePadding: true,
        label: 'Dirección',
    },
    { 
        id: 'taxpayer',
        numeric: false,
        disablePadding: true,
        label: 'Contribuyente',
    },
    { 
        id: 'item',
        numeric: false,
        disablePadding: true,
        label: 'Rubro',
    },
    { 
        id: 'status',
        numeric: false,
        disablePadding: true,
        label: 'Estado',
        align: 'right'
    },
    { 
        id: 'actions',
        numeric: false,
        disablePadding: true,
        label: 'Acciones',
        align: 'center'
    }
];

const CubicleList = ({ initialValues, createButton, title = 'Padrón de cubículos' }) => {
    const isSmall = useMediaQuery(theme =>
        theme.breakpoints.down('sm')
    )
    const [filter, setFilter] = React.useState(initialValues)
    const { state: { perPage, page } } = useAdmin()
    const { loading, total, data } = useFetch('/cubicles', {
        perPage: perPage,
        page: page,
        filter: filter
    })
    const [items, setItems] = React.useState({})
    const { enqueueSnackbar } = useSnackbar();
    const handleOnChange = (e) => {
        if (e.currentTarget.value) {
            const value = e.currentTarget.value;

            setFilter(prevState => ({ ...prevState, address: value }))
        } else {
            setFilter(initialValues)
        }
    }
    const onSelectInputChange = (e, newInputValue) => {
        if (newInputValue) {
            setFilter(prevState => ({ ...prevState, active: newInputValue.value }))
        } else {
            setFilter(initialValues)
        }
    }

    const handleDelete = React.useCallback(async (values) => {
        const { data } = await axios.delete(`/cubicles/${values.id}`);

        if (data) {
            setItems(prevItems => [
                ...prevItems.filter(({ id }) => id != data.id),
                data  
            ])
            enqueueSnackbar(
                `¡Ha desincorporado el cubículo "${data.address}"`, 
                { variant: 'success' }
            );
        }
    }, [])

    const rowRender = () => (
        items.map(row => (
            <TableRow hover tabIndex={-1} key={row.address}>
                <TableCell
                    component="th"
                    id={row.id}
                    scope="row"
                    padding="normal"
                    width='40%'
                >
                    {row.address}
                </TableCell>
                <TableCell
                    component="th"
                    id={row.id}
                    scope="row"
                    padding="normal"
                    width='30%'
                >
                    {row.taxpayer.name}
                </TableCell>
                <TableCell
                    component="th"
                    id={row.id}
                    scope="row"
                    padding="normal"
                    width='10%'
                    textAlign='center'
                >
                    {row.item.name}
                </TableCell>
                <TableCell
                    component="th"
                    id={row.id}
                    scope="row"
                    padding="normal"
                    width='10%'
                    sx={{
                        textAlign: 'center'
                    }}
                >
                    {row.active ? 'Activo' : 'Desincorporado'}
                </TableCell>
                <TableCell
                    scope="row"
                    align='right'
                    width='10%'
                >
                    <Box sx={{ display: 'flex', justifyContent: 'center' }}>
                        <LinkIconButton href={`/cubicles/${row.id}/edit`} />
                        {row.active ? (
                            <DeleteButton
                                title={`¿Está seguro que desea desincorporar el cubículo "${row.address}"?`}
                                onClick={() => handleDelete(row)}
                            />
                        ) : null}
                    </Box>
                </TableCell>
            </TableRow>
        )))

    React.useEffect(() => setItems(data), [data])

    return (
        <ListContainer title="Cubículos">
            <Box sx={{ display: 'flex', justifyContent: 'space-between' }}>
                <Box sx={{
                    width: isSmall ? '100%' : '60%',
                    backgroundColor: '#fff'
                }}>
                    <Grid container spacing={2}>
                        <Grid item sm={6}>
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
                        </Grid>
                        <Grid item sm={6}>
                            <Autocomplete 
                                disablePortal
                                options={options}
                                fullWidth
                                renderInput={(params) => <TextField {...params} label="Estado" />}
                                onChange={onSelectInputChange}
                            />
                        </Grid>
                    </Grid>
                </Box>
                <Box sx={{
                    display: 'flex',
                    height: '2rem',
                    width: '8rem',
                    justifyContent: !createButton ? 'end' : 'space-between',
                    alignContent: 'center'
                }}>
                    {items.length ? (
                        <PrintButton
                            perPage={10}
                            filter={filter}
                            basePath='/cubicles'
                            filename='cubiculos.pdf'
                            type='pdf'
                            title={title}
                        />
                    ) : <></>}
                    {(createButton) && (
                        <ButtonLink
                            color="primary"
                            variant="contained"
                            to={`/cubicles/${initialValues.taxpayer_id}/create`}
                        />
                    )}
                </Box>
            </Box>
            <Table
                headCells={headCells}
                rows={items.length && rowRender()}
                loading={loading}
                total={total}
            />
        </ListContainer>
    )
}

CubicleList.defaultProps = {
    initialValues: {},
    createButton: false,
    showTaxpayer: false
}

export default CubicleList
