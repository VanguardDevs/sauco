import * as React from 'react';
import Box from '@mui/material/Box'
import { Link } from 'react-router-dom'
import { alpha, Button } from '@mui/material';

const NotFound = () => (
    <Box sx={{
        display: 'flex',
        flexDirection: 'column',
        alignItems: 'center',
        justifyContent: 'center',
        width: '100%',
        height: '100%',
        backgroundColor: theme => theme.palette.secondary.main
    }}>
        <Box
            sx={{
                color: theme => theme.palette.primary.main,
                fontWeight: 900,
                fontSize: '5rem',
            }}
        >
            OOOPS!
        </Box>
        <Box>
            La página que estabas buscando no ha sido encontrada.
        </Box>
        <Button
            component={Link}
            to='/'
            sx={{
                borderRadius: '12px',
                backgroundColor: theme => alpha(theme.palette.primary.main, 1),
                color: '#fff',
                padding: '0.4rem 1.4rem',
                fontWeight: 600,
                marginTop: '1rem',
                '&:hover': {
                    backgroundColor: theme => alpha(theme.palette.primary.main, 0.9)
                }
            }}
        >
            Volver al inicio
        </Button>
    </Box>
);

export default NotFound;
