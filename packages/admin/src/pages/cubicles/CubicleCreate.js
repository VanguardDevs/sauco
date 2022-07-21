import * as React from 'react'
import { createCubicle } from './cubicleValidations';
import TextInput from '../../components/TextInput'
import axios from '../../api'
import { useNavigate, useParams } from 'react-router-dom'
import { useSnackbar } from 'notistack';
import SelectItemInput from './SelectItemInput';
import { FieldArray } from 'react-final-form-arrays'
import Box from '@mui/material/Box'
import Grid from '@mui/material/Grid'
import { Form } from 'react-final-form'
import Button from '@mui/material/Button'
import arrayMutators from 'final-form-arrays'
import { setTitle, useAdmin } from '../../context/AdminContext'
import useMediaQuery from '@mui/material/useMediaQuery';
import Table from '@mui/material/Table';
import TableBody from '@mui/material/TableBody';
import TableCell from '@mui/material/TableCell';
import TableRow from '@mui/material/TableRow';
import IconButton from '@mui/material/IconButton';
import DeleteIcon from '@mui/icons-material/Delete';
import AddIcon from '@mui/icons-material/Add';
import FormHelperText from '@mui/material/FormHelperText';

const CubicleCreate = () => {
    const { id } = useParams();
    const navigate = useNavigate()
    const { enqueueSnackbar } = useSnackbar();
    const { dispatch } = useAdmin()
    const matches = useMediaQuery((theme) => theme.breakpoints.down('sm'));

    const save = React.useCallback(async (values) => {
        try {
            const { data } = await axios.post('/cubicles', {
                ...values,
                taxpayer_id: id
            })

            if (data) {
                navigate(`/taxpayers/${id}`)
                enqueueSnackbar(`¡Ha registrado "${data.cubiclesCount}" cubículos!`, { variant: 'success' });
            }
        } catch (error) {
            if (error.response.data.errors) {
                return error.response.data.errors;
            }
        }
    }, [])

    React.useEffect(() => {
        setTitle(dispatch, 'Crear cubículos')
    }, [])

    return (
        <Box component='div' width='100%'>
            <Box fontWeight='600' fontSize='1.1rem'>
                Seleccione un rubro y agregue las direcciones de los cubículos.
            </Box>
            <Box component='div' paddingTop='2rem'  width='100%'>
                <Form
                    onSubmit={save}
                    validate={createCubicle}
                    initialValues={{
                        cubicles: [{}]
                    }}
                    mutators={{
                        ...arrayMutators
                    }}
                    render={ ({
                        handleSubmit,
                        submitting,
                        form: {
                            mutators: { push }
                        },
                        errors,
                        values
                    }) => (
                        <form onSubmit={handleSubmit}>
                            <Box sx={{
                                maxWidth: '90rem',
                                backgroundColor: theme => theme.palette.secondary.main,
                                padding: '1rem 2rem'
                            }}>
                                <Grid container spacing={1}>
                                    <SelectItemInput disabled={submitting} />
                                    <Box sx={{
                                        display: 'flex',
                                        width: '100%',
                                        justifyContent: 'space-between',
                                        marginTop: '2rem',
                                        fontSize: '1.1rem'
                                    }}>
                                        <Box fontWeight='600'>
                                            Agregue uno o más cubículos
                                        </Box>
                                        <Grid item xs={12} md={2}>
                                            <Button
                                                variant='contained'
                                                type="button"
                                                onClick={() => push('cubicles', undefined)}
                                                startIcon={<AddIcon />}
                                                fullWidth
                                            >
                                                Agregar
                                            </Button>
                                        </Grid>
                                    </Box>
                                    <Table>
                                        <TableBody>
                                            <FieldArray name="cubicles">
                                                {({ fields }) =>
                                                    fields.map((name, index) => (
                                                        <TableRow sx={{
                                                            display: 'flex',
                                                            alignItems: 'center'
                                                        }}>
                                                            <TableCell sx={{
                                                                fontWeight: 600
                                                            }}>
                                                                #{index + 1}
                                                            </TableCell>
                                                            <TableCell width='100%'>
                                                                <TextInput
                                                                    name={`${name}.address`}
                                                                    placeholder='Dirección'
                                                                    disabled={submitting}
                                                                />
                                                            </TableCell>
                                                            <TableCell>
                                                                <IconButton
                                                                    variant="outlined"
                                                                    type="button"
                                                                    onClick={() => (values.cubicles.length > 1) ? fields.remove(index) : null}
                                                                    disabled={!(values.cubicles.length > 1)}
                                                                >
                                                                    <DeleteIcon />
                                                                </IconButton>
                                                            </TableCell>
                                                        </TableRow>
                                                    ))
                                                }
                                            </FieldArray>
                                        </TableBody>
                                    </Table>
                                    <Grid container>
                                        <Grid item xs={12} md={3}>
                                            {errors.cubicles_field && <FormHelperText error>{errors.cubicles_field}</FormHelperText>}
                                        </Grid>
                                    </Grid>
                                    <Box sx={{
                                        display: 'flex',
                                        width: '100%',
                                        justifyContent: 'flex-end',
                                        padding: '1rem 0.5rem'
                                    }}>
                                        <Button
                                            disabled={submitting}
                                            onClick={event => {
                                                if (event) {
                                                    event.preventDefault();
                                                    handleSubmit();
                                                }
                                            }}
                                            type="submit"
                                            color='primary'
                                            variant="contained"
                                        >
                                            Guardar
                                        </Button>
                                    </Box>
                                </Grid>
                            </Box>
                        </form>
                    )}
                />
            </Box>
        </Box>
    )
}

export default CubicleCreate
