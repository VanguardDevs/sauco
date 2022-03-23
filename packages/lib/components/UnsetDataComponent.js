import Box from '@material-ui/core/Box'
import PropTypes from 'prop-types'
import Typography from '@material-ui/core/Typography'

const UnsetDataComponent = ({ message }) => {
    return (
        <Box paddingTop='2rem'>
            <Typography variant="body1">
                {message}
            </Typography>
        </Box>
    )
}

UnsetDataComponent.propTypes = {
    message: PropTypes.string
};

export default UnsetDataComponent
