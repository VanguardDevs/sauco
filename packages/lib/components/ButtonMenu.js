import * as React from "react";
import {
  MenuItem,
  Typography,
  ListItemIcon
} from '@material-ui/core';

const ButtonMenu = React.forwardRef(( props, ref ) => (
  <MenuItem
    onClick={props.onClick}
  >
    <ListItemIcon>
      {props.icon}
      <Typography fontSize="small">
        &nbsp;
        {props.label}
      </Typography>
    </ListItemIcon>
  </MenuItem>
));

export default ButtonMenu;

