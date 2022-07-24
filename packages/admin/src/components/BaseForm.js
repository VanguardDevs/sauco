import * as React from 'react'
import Box from '@mui/material/Box'
import Grid from '@mui/material/Grid'
// import { Form } from 'react-final-form'
import { useForm } from 'react-hook-form'
import Button from '@mui/material/Button'
import PropTypes from 'prop-types'
import useMediaQuery from '@mui/material/useMediaQuery';
import { setTitle, useAdmin } from '../context/AdminContext'

const BaseForm = ({
    children,
    saveButtonLabel,
    loading,
    noButton,
    unresponsive,
    validate,
    save,
    record,
    initialValues,
    defaultValue,
    title,
    ...rest
}) => {
    const { dispatch } = useAdmin()
    const { handleSubmit, control, formState: { isSubmitting } } = useForm({
        defaultValues: record
    })
    const matches = useMediaQuery((theme) => theme.breakpoints.down('sm'));

    React.useEffect(() => {
        setTitle(dispatch, title)
    }, [title])

    return (
        <Box component='div' width='100%'>
            <Box component='div' paddingTop='2rem'  width='100%'>
                <form onSubmit={handleSubmit(save)}>
                    <Box sx={{
                        maxWidth: '90rem',
                        backgroundColor: theme => theme.palette.secondary.main,
                        padding: '1rem 2rem'
                    }}>
                        <Grid container spacing={1}>
                            {
                                React.Children.map(children, child =>
                                    React.cloneElement(child, {
                                        control: control,
                                        disabled: isSubmitting
                                    })
                                )
                            }
                            <Box sx={{
                                display: 'flex',
                                width: '100%',
                                justifyContent: 'flex-end',
                                padding: '1rem 0.5rem'
                            }}>
                                {!noButton && (
                                    <Button
                                        disabled={isSubmitting}
                                        type="submit"
                                        color='primary'
                                        variant="contained"
                                        fullWidth={matches}
                                    >
                                        {saveButtonLabel}
                                    </Button>
                                )}
                            </Box>
                        </Grid>
                    </Box>
                </form>
            </Box>
        </Box>
    );
}

BaseForm.propTypes = {
    saveButtonLabel: PropTypes.string,
    disabled: PropTypes.bool,
    title: PropTypes.string,
}

BaseForm.defaultProps = {
    saveButtonLabel: 'Guardar',
    title: '',
    disabled: false,
    noButton: false,
    unresponsive: false
}

export default BaseForm;
