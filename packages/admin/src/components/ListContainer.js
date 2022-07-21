import * as React from 'react'
import Box from '@mui/material/Box'
import { setTitle, useAdmin } from '../context/AdminContext'

const ListContainer = ({ children, title }) => {
    const { dispatch } = useAdmin()

    React.useEffect(() => {
        setTitle(dispatch, title)
    }, [title])

    
    return (
        <Box sx={{
            flexDirection: 'column',
            width: '100%',
            display: 'flex',
            padding: '1rem',
            borderRadius: '4px',
            backgroundColor: theme => theme.palette.secondary.main
        }}>
            {children}
        </Box>
    )
}

export default ListContainer
