import * as React from 'react';
import { Form } from 'react-final-form';
import Box from '@mui/material/Box'
import Button from '@mui/material/Button'
import TextInput from '../../components/TextInput'
import PasswordInput from '../../components/PasswordInput'
import InputContainer from '../../components/InputContainer'
import axios from '../../api'
import { useNavigate } from 'react-router-dom'
import { useAuth, loginUser } from '../../context/AuthContext'
import fondo from '../../images/Fondo.jpg'

const validate = (values) => {
    const errors = {};

    if (!values.login) {
        errors.login = 'Ingrese su nombre de usuario';
    }

    if (!values.password) {
        errors.password = 'Ingrese su contraseña';
    }

    return errors;
};

const Login = () => {
    const navigate = useNavigate();
    const { dispatch } = useAuth();

    const handleSubmit = React.useCallback(async (values) => {
        return await axios.post('/login', values)
            .then(async (res) => {
                const { data } = res
                await axios.get('/csrf-cookie');
                loginUser(dispatch, data)

                await navigate('/');
            }).catch(err => {
                if (err.response.status == 500) {
                    navigate('/error', { replace: true });
                }

                if (err.response.data.errors) {
                    return err.response.data.errors;
                }
            });
    }, [])

    return (
        <Box sx={{
            display: 'flex',
            alignItems: 'center',
            justifyContent: 'center',
            width: '100%',
            height: '100%',
            background: `url(${fondo}) no-repeat center center fixed`,
            backgroundColor: theme => theme.palette.primary.main,
            backgroundSize: 'cover'
        }}>
            <Box
                component='div'
                sx={{
                    maxWidth: '20rem',
                    padding: '2rem',
                    backgroundColor: theme => theme.palette.secondary.main,
                    borderRadius: '6px',
                }}
            >
                <Form
                    onSubmit={handleSubmit}
                    validate={validate}
                    render={ ({ handleSubmit, submitting }) => (
                        <form onSubmit={handleSubmit}>
                            <Box
                                height='18rem'
                                display='flex'
                                flexDirection='column'
                                justifyContent='space-between'
                            >
                                <Box sx={{
                                    fontSize: '2rem',
                                    fontWeight: 600,
                                    color: theme => theme.palette.primary.main,
                                    textAlign: 'center',
                                    padding: '0.25rem 0'
                                }}>
                                    {process.env.REACT_APP_NAME}
                                </Box>
                                <Box>
                                    <InputContainer label='Usuario' md={12}>
                                        <TextInput
                                            name="login"
                                            placeholder="Ingrese su nombre de usuario"
                                            disabled={submitting}
                                            fullWidth
                                        />
                                    </InputContainer>
                                    <InputContainer label='Contraseña' md={12}>
                                        <PasswordInput
                                            name="password"
                                            placeholder="Ingrese su contraseña"
                                            disabled={submitting}
                                            fullWidth
                                        />
                                    </InputContainer>
                                </Box>
                                <Box paddingTop='1rem'>
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
                                        sx={{
                                            textTransform: 'uppercase'
                                        }}
                                        fullWidth
                                    >
                                        Acceder
                                    </Button>
                                </Box>
                            </Box>
                        </form>
                    )}
                />
            </Box>
        </Box>
    );
};

export default Login;
