import Box from '@mui/material/Box'
import mayorLogo from '../../images/mayorLogo.png'
import sumatLogo from '../../images/sumat.png'

const Strong = ({ children }) => (
    <Box component='span' sx={{
        color: theme => theme.palette.primary.main,
        fontWeight: 900
    }}>
        {children}
    </Box>
)

const Welcome = () => {
    return (
        <Box sx={{
            fontSize: '2rem',
            display: 'flex',
            backgroundColor: theme => theme.palette.secondary.main,
            width: '100%',
            padding: '2rem 1rem',
            flexDirection: 'column'
        }}>
            <Box width='100%'>
                ¡Bienvenido a <Strong>{process.env.REACT_APP_NAME.slice(0, 1)}</Strong>{process.env.REACT_APP_NAME.slice(1)}!
            </Box>
            <Box sx={{
                paddingTop: '2rem',
                width: '40%',
                display: 'flex',
                justifyContent: 'space-between',
                flexDirection: 'row',
                alignItems: 'center'
            }}>
                <img height='75rem' src={mayorLogo} />
                <img height='75rem' src={sumatLogo} />
            </Box>
        </Box>
    )
}

export default Welcome
