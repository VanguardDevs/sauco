import Box from '@material-ui/core/Box'
import PropTypes from 'prop-types'
import Typography from '@material-ui/core/Typography'

const EmptyMessageComponent = ({ message }) => {
    return (
        <Box paddingTop='2rem'>
            <Typography variant="body1">
                {message}
            </Typography>
        </Box>
    )
}

EmptyMessageComponent.propTypes = {
    message: PropTypes.string
};

export default EmptyMessageComponent
