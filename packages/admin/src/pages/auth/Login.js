import * as React from 'react';
import { useForm } from 'react-hook-form'
import Box from '@mui/material/Box'
import Button from '@mui/material/Button'
import TextInput from '../../components/TextInput'
import PasswordInput from '../../components/PasswordInput'
import InputContainer from '../../components/InputContainer'
import axios from '../../api'
import { useNavigate } from 'react-router-dom'
import { useAuth, loginUser } from '../../context/AuthContext'
import fondo from '../../images/Fondo.jpg'
import formatServerSideErrors from '../../utils/formatServerSideErrors';

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
    const {
        handleSubmit,
        control,
        formState: {
            isSubmitting
        },
        setError
    } = useForm();

    const onSubmit = async (values) => {
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
                    const { errors } = err.response.data;

                    formatServerSideErrors(errors, setError);
                }
            });
    }

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
                <Box
                    height='18rem'
                    display='flex'
                    flexDirection='column'
                    justifyContent='space-between'
                >
                    <form onSubmit={handleSubmit(onSubmit)}>
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
                                <TextInput control={control} name='login' />
                            </InputContainer>
                            <InputContainer label='Contraseña' md={12}>
                                <PasswordInput control={control} name="password" />
                            </InputContainer>
                        </Box>
                        <Box paddingTop='1rem'>
                            <Button
                                disabled={isSubmitting}
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
                    </form>
                </Box>
            </Box>
        </Box>
    );
};

export default Login;
