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
import { useAuth } from '../../context/AuthContext'
import BlockButton from '../../components/BlockButton'
import axios from '../../api'
import { useSnackbar } from 'notistack';
import { useAdmin } from '../../context/AdminContext'

const headCells = [
    { 
        id: 'name',
        numeric: false,
        disablePadding: true,
        label: 'Nombre',
    },
    { 
        id: 'login',
        numeric: false,
        disablePadding: true,
        label: 'Usuario',
    },
    { 
        id: 'cedula',
        numeric: false,
        disablePadding: true,
        label: 'Cédula',
    },
    { 
        id: 'actions',
        numeric: false,
        disablePadding: true,
        label: 'Acciones',
    }
];

const UserList = () => {
    const { state: { perPage, page } } = useAdmin()
    const isSmall = useMediaQuery(theme =>
        theme.breakpoints.down('sm')
    )
    const { state: { user } } = useAuth();
    const [filter, setFilter] = React.useState({})
    const { loading, total, data } = useFetch('/users', {
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

    const handleUpdateStatus = React.useCallback(async (values) => {
        const { data } = await axios.post(`/users/${values.id}/update-status`);

        if (data) {
            setItems(prevItems => [
                data,
                ...prevItems.filter(({ id }) => id != data.id)
            ])
            enqueueSnackbar(
                `¡Ha ${data.active ? 'activado' : 'desactivado'} el usuario "${data.names}"`, 
                { variant: 'success' }
            );
        }
    }, [])

    const rowRender = () => (
        items.map(row => (
            <TableRow hover tabIndex={-1} key={row.name}>
                <TableCell
                    component="th"
                    id={row.id}
                    scope="row"
                    padding="normal"
                    width='40%'
                >
                    {row.names} {row.surnames}
                </TableCell>
                <TableCell
                    component="th"
                    id={row.id}
                    scope="row"
                    padding="normal"
                    width='10%'
                >
                    {row.login}
                </TableCell>
                <TableCell
                    component="th"
                    id={row.id}
                    scope="row"
                    padding="normal"
                    width='10%'
                >
                    {row.identity_card}
                </TableCell>
                <TableCell
                    scope="row"
                    align='right'
                    width='10%'
                >
                    <Box display="flex" justifyContent='center'>
                        <LinkIconButton href={`/users/${row.id}/edit`} />
                        {(row.id != user.id) && (
                            <BlockButton
                                title={`¿Está seguro que desea desactivar el usuario "${row.login}"?`}
                                onClick={() => handleUpdateStatus(row)}
                                active={row.active}
                            />
                        )}
                    </Box>
                </TableCell>
            </TableRow>
        ))
    )

    React.useEffect(() => setItems(data), [data])

    return (
        <ListContainer title="Usuarios">
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
                <Box>
                    <ButtonLink
                        color="primary"
                        variant="contained"
                        to="/users/create"
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

export default UserList
