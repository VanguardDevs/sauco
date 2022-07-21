import * as React from 'react';
import Box from '@mui/material/Box'
import { useNavigate } from 'react-router-dom'
import { alpha, Button } from '@mui/material';

const Unauthorized = () => {
    const navigate = useNavigate();

    return (
        <Box sx={{
            display: 'flex',
            flexDirection: 'column',
            alignItems: 'center',
            justifyContent: 'center',
            width: '100%',
            height: '100%',
            backgroundColor: theme => theme.palette.secondary.main,
            padding: '2rem'
        }}>
            <Box
                sx={{
                    color: theme => theme.palette.primary.main,
                    fontWeight: 900,
                    fontSize: '5rem',
                }}
            >
                ¡LO SENTIMOS!
            </Box>
            <Box>
                Usted no tiene los permisos para acceder a este módulo.
            </Box>
            <Button
                onClick={() => navigate(-1)}
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
                Volver
            </Button>
        </Box>
    );
}

export default Unauthorized;
