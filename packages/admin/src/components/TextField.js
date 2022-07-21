import * as React from 'react'
import Box from '@mui/material/Box'
import AssignmentIndIcon from '@mui/icons-material/AssignmentInd';
import Icon from '@mui/material/Icon'

const TextField = ({ icon, source }) => {
    return (
        <Box sx={{
            display: 'flex',
            alignItems: 'center'
        }}>
            {icon && (
                <Icon fontSize='medium'>
                    {icon}
                </Icon>
            )}
            {source}
        </Box>
    )
}

export default TextField
