import * as React from 'react'
import Box from '@mui/material/Box'
import { useNavigate } from 'react-router-dom'

const StatsBox = ({ title, total, icon, to }) => {
    const navigate = useNavigate();

    return (
        <Box
            elevation={3}
            sx={{
                display: 'flex',
                cursor: 'pointer',
                padding: '2rem',
                minWidth: '300px',
                maxWidth: '300px',
                boxShadow: 3,
                borderRadius: 2,
                marginRight: '1rem',
                marginBottom: '1rem'
            }}
            onClick={() => navigate(to)}
        >
            <Box display='flex' flexDirection='column' flex='1.5'>
                <Box sx={{
                    fontWeight: 900,
                    width: '100%',
                    fontSize: '3rem'
                }}>
                    {total}
                </Box>
                <Box sx={{
                    width: '100%',
                    fontWeight: 900,
                    fontSize: '1.1rem'
                }}>
                    {title}
                </Box>
            </Box>
            <Box
                sx={{
                    display: 'flex',
                    flex: 1,
                    alignItems: 'center',
                    justifyContent: 'end'
                }}
            >
                {icon}
            </Box>
        </Box>
    )
}

export default StatsBox