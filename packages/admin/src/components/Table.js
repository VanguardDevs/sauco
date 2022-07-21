import * as React from 'react';
import Box from '@mui/material/Box';
import Table from '@mui/material/Table';
import TableBody from '@mui/material/TableBody';
import TableCell from '@mui/material/TableCell';
import TableContainer from '@mui/material/TableContainer';
import TablePagination from '@mui/material/TablePagination';
import TableRow from '@mui/material/TableRow';
import Paper from '@mui/material/Paper';
import TableHead from './TableHead'
import LinearProgress from '@mui/material/LinearProgress';
import { useAdmin, setPage, setPerPage } from '../context/AdminContext'

const EnhancedTable = ({
    headCells, rows, loading, total
}) => {
    const [order, setOrder] = React.useState('asc')
    const { dispatch, state: { perPage, page } } = useAdmin();
    const [orderBy, setOrderBy] = React.useState('calories');

    const handleChangePage = (event, newPage) => {
        setPage(dispatch, newPage);
    };

    const handleChangeRowsPerPage = (event) => {
        setPerPage(dispatch, parseInt(event.target.value, 10));
        setPage(dispatch, 0)
    };

    return (
        <Box sx={{ width: '100%', marginTop: '1.5rem' }}>
            <Paper sx={{ width: '100%', mb: 2 }}>
                <TableContainer>
                    <Table
                        sx={{ minWidth: 750 }}
                        aria-labelledby="tableTitle"
                        size={loading ? 'medium' : 'small'}
                    >
                        <TableHead
                            headCells={headCells}
                        />
                        <TableBody>
                            {(rows.length && !loading) ? rows : (
                                loading ? (
                                    <TableRow>
                                        <TableCell
                                            align='center'
                                            padding="normal"
                                            width='100%'
                                            colSpan={headCells.length}
                                        >
                                            <Box display='flex' justifyContent='center' width='100%'>
                                                <LinearProgress sx={{ width: '25%' }} />
                                            </Box>
                                        </TableCell>
                                    </TableRow> 
                                ) : (
                                    <TableRow>
                                        <TableCell
                                            align='center'
                                            scope="row"
                                            padding="normal"
                                            width='100%'
                                        >
                                            Sin registros
                                        </TableCell>
                                    </TableRow>
                                )
                            )}
                        </TableBody>
                    </Table>
                </TableContainer>
                <TablePagination
                    rowsPerPageOptions={[5, 10, 25]}
                    component="div"
                    count={total}
                    rowsPerPage={perPage}
                    page={page}
                    onPageChange={handleChangePage}
                    onRowsPerPageChange={handleChangeRowsPerPage}
                />
            </Paper>
        </Box>
    );
}

EnhancedTable.defaultProps = {
    rows: 0
}

export default EnhancedTable
