import MenuItem from '@material-ui/core/MenuItem';
import ListItemIcon from '@material-ui/core/ListItemIcon';
import Settings from '@material-ui/icons/Settings';

const OptionMenuItem = ({ icon, name }) => (
    <MenuItem>
        <ListItemIcon>
            {icon}
        </ListItemIcon>
            {name}
    </MenuItem>
)

OptionMenuItem.defaultProps = {
    name: 'Nombre',
    icon: <Settings fontSize="small" />
};

export default OptionMenuItem;
