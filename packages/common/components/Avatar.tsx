import MuiAvatar from '@material-ui/core/Avatar';
import Box from '@material-ui/core/Box'

const Avatar = ({ picture } : Props) => (
    <Box display="flex" justifyContent="center" alignContent="center">
        <MuiAvatar
            src={`${process.env.REACT_APP_API_DOMAIN}/${picture}`}
            alt='Picture'
        />
    </Box>
);

interface Props {
    picture?: string;
}

export default Avatar;
