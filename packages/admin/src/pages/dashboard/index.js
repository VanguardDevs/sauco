import Box from '@mui/material/Box'
import React from 'react'
import { setTitle, useAdmin } from '../../context/AdminContext'
import Welcome from './Welcome'
import StatsBox from './StatsBox'
import BusinessCenterIcon from '@mui/icons-material/BusinessCenter';
import StorefrontIcon from '@mui/icons-material/Storefront';
import axios from '../../api'
import { styled } from '@mui/system';

const Container = styled(Box)(({ theme }) => ({
    display: 'flex',
    width: '100%',
    flexDirection: 'row',
    marginTop: '2rem',
    [theme.breakpoints.down('md')]: {
        flexDirection: 'column',
        alignItems: 'center'
    },
}));

const initialState = {
    taxpayers: 0,
    cubicles: 0
}

const Dashboard = () => {
    const [state, setState] = React.useState(initialState)
    const { dispatch } = useAdmin()

    const fetchStatistics = React.useCallback(async () => {
        const { data } = await axios.get(`statistics`)
        setState(data)
    }, []);

    React.useEffect(() => {
        setTitle(dispatch, 'Inicio')
        fetchStatistics();
    }, [])

    const { taxpayers, cubicles } = state;

    return (
        <Box display='flex' width='100%' flexDirection='column'>
            <Welcome />
            <Box marginTop='2rem'>
                <Box fontWeight='600' width='100%' fontSize='1.5rem'>
                    Estadísticas
                </Box>
                <Container>
                    <StatsBox
                        total={taxpayers}
                        title='Contribuyentes'
                        to='/taxpayers'
                        icon={<BusinessCenterIcon color='primary' sx={{
                            fontSize: '70px'
                        }} />}
                    />
                    <StatsBox
                        title='Cubículos'
                        to='/cubicles'
                        total={cubicles}
                        icon={<StorefrontIcon color='primary' sx={{
                            fontSize: '70px'
                        }} />}
                    />
                </Container>
            </Box>
        </Box>
    )
}

export default Dashboard