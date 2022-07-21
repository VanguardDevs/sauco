import * as React from 'react';
import Box from '@mui/material/Box'
import { Link } from '@mui/material';

const Docs = () => (
    <Box sx={{
        width: '100%',
        height: '100%',
        backgroundColor: theme => theme.palette.secondary.main,
        padding: '2rem'
    }}>
        <Box
            sx={{
                color: theme => theme.palette.primary.main,
                fontWeight: 900,
                fontSize: '2rem',
            }}
        >
            {process.env.REACT_APP_NAME} V.1
        </Box>
        <Box sx={{
            display: 'flex',
            alignItems: 'center'
        }}>
            Presione
            <Link sx={{ margin: '0 0.2rem'}}>
                aquí
            </Link>
            para descargar nuestro manual en PDF.
        </Box>
    </Box>
);

export default Docs;
