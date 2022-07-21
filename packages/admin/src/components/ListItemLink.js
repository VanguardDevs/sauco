import * as React from 'react'
import ListItem from '@mui/material/ListItem';
import ListItemText from '@mui/material/ListItemText';
import ListItemIcon from '@mui/material/ListItemIcon';
import { NavLink } from "react-router-dom";
import { grey } from '@mui/material/colors';

const activeStyle = {
    backgroundColor: grey[200]
}

const ListItemLink = props => {
    const { icon, primary, to, ...rest } = props;
  
    const renderLink = React.useMemo(
        () =>
            React.forwardRef(function Link(itemProps, ref) {
                return <NavLink
                    to={to}
                    ref={ref}
                    style={({ isActive }) =>
                        isActive ? activeStyle : undefined
                    }
                    {...itemProps}
                />;
            }),
        [to],
    );
  
    return (
        <li>
            <ListItem button component={renderLink} {...rest}>
                {icon ? <ListItemIcon sx={{ color: theme => theme.palette.primary.main }}>{icon}</ListItemIcon> : null}
                <ListItemText primary={primary} />
            </ListItem>
        </li>
    );
}

export default ListItemLink