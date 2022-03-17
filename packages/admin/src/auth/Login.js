import * as React from 'react';
import {
    CardActions,
    Box,
    Typography,
    makeStyles
} from '@material-ui/core';
import Button from '@sauco/lib/components/Button'
import { axios } from '@sauco/lib/providers'
import InputContainer from '@sauco/lib/components/InputContainer'
import AuthLayout from '@sauco/lib/layouts/AuthLayout'
import formStyles from '@sauco/lib/styles/formStyles'
import { theme } from '@sauco/lib/styles';
import { ThemeProvider, createMuiTheme } from '@material-ui/core';
import { Link, useHistory } from 'react-router-dom'
import { TextInput, PasswordInput } from 'react-admin'
import { useUserDispatch } from '@sauco/lib/hooks/useUserState'

const validate = (values) => {
    const errors = {};

    if (!values.email) {
        errors.email = 'Ingrese su correo electrónico';
    }

    if (!values.password) {
        errors.password = 'Ingrese su contraseña';
    }

    return errors;
};

const useStyles = makeStyles(() => ({
    form: {
        width: '100%',
        padding: '0 1.5rem'
    },
    cardHeader: {
        textAlign: 'center',
        marginBottom: '2rem'
    },
}));

const Login = () => {
    const [loading, setLoading] = React.useState(false);
    const classes = { ...formStyles(), ...useStyles() };
    const history = useHistory()
    const { setUser } = useUserDispatch();

    const handleSubmit = React.useCallback(async (values) => {
        setLoading(true)

        return await axios.post(`${process.env.REACT_APP_API_DOMAIN}/api/login`, values)
            .then(async (res) => {
                await axios.get('/api/csrf-cookie')
                await setUser({
                    user: res.data.user,
                    token: res.data.token
                });
                await history.push('/');

                setLoading(false);
            }).catch(err => {
                setLoading(false);

                if (err.response.status == 500) {
                    history.push('/error');
                }

                if (err.response.data.errors) {
                    return err.response.data.errors;
                }
            });
    }, [])

    return (
        <AuthLayout validate={validate} handleSubmit={handleSubmit} title='Iniciar sesión'>
            <div className={classes.form}>
                <Box className={classes.cardHeader}>
                    <img src={`${process.env.PUBLIC_URL}/logotipo.png`} alt='approbado_logotipo' height="50px" width="200px" />
                    <Typography variant="subtitle1" classKey='p'>
                        Administrador
                    </Typography>
                </Box>

                <InputContainer labelName='Correo electrónico' md={12}>
                    <TextInput
                        source="email"
                        placeholder="Ingrese su correo electrónico"
                        disabled={loading}
                        fullWidth
                    />
                </InputContainer>
                <InputContainer labelName='Contraseña' md={12}>
                    <PasswordInput
                        source="password"
                        placeholder="Ingrese su contraseña"
                        disabled={loading}
                        fullWidth
                    />
                </InputContainer>
                <Box component="div" display='flex' justifyContent="center" marginTop="1rem">
                    <Link to="/reset-password" className={classes.link}>¿Olvidaste tu contraseña?</Link>
                </Box>
                <CardActions className={classes.actions}>
                    <Button disabled={loading} unresponsive fullWidth>
                        Iniciar sesión
                    </Button>
                </CardActions>
            </div>
        </AuthLayout >
    );
};

const LoginWithTheme = props => (
    <ThemeProvider theme={createMuiTheme(theme)}>
        <Login {...props} />
    </ThemeProvider>
);

export default LoginWithTheme;
