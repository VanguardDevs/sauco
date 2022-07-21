import IconButton from '@mui/material/IconButton'
import EditIcon from '@mui/icons-material/Edit';
import LinkBehavior from './LinkBehavior';

const LinkIconButton = ({ href, icon, ...rest }) => (
    <IconButton component={LinkBehavior} to={href} {...rest}>
        {icon}
    </IconButton>
)

LinkIconButton.defaultProps = {
    icon: <EditIcon />
}

export default LinkIconButton
