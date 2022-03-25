import * as React from 'react';
import ExpandMore from '@material-ui/icons/ExpandMore';
import ExpandLess from '@material-ui/icons/ExpandLess';
import List from '@material-ui/core/List';
import MenuItem from '@material-ui/core/MenuItem';
import ListItemIcon from '@material-ui/core/ListItemIcon';
import Typography from '@material-ui/core/Typography';
import Collapse from '@material-ui/core/Collapse';
import Tooltip from '@material-ui/core/Tooltip';
import { makeStyles } from '@material-ui/core/styles';

const useStyles = makeStyles(theme => ({
    icon: { minWidth: theme.spacing(5), color: 'white' },
    sidebarIsOpen: {
        '& a': {
            color: 'white',
            paddingLeft: theme.spacing(4),
            transition: 'padding-left 195ms cubic-bezier(0.4, 0, 0.6, 1) 0ms',
        },
    },
    sidebarIsClosed: {
        '& a': {
            color: 'white',
            paddingLeft: theme.spacing(2),
            transition: 'padding-left 195ms cubic-bezier(0.4, 0, 0.6, 1) 0ms',
        },
    },
}));

const SubMenu = ({
    handleToggle,
    sidebarIsOpen,
    isOpen,
    name,
    icon,
    children,
    dense
}) => {
    const classes = useStyles();

    const header = (
        <MenuItem dense={dense} button onClick={handleToggle}>
            <ListItemIcon className={classes.icon}>

                {isOpen ? <ExpandMore /> : icon }

            {
                (sidebarIsOpen) && (
                    <Typography variant="subtitle1" color="textSecondary">
                        {name}
                    </Typography>
                )
            }
            </ListItemIcon>
        </MenuItem>
    );

    return (
        <React.Fragment>
            {sidebarIsOpen || isOpen ? (
                header
            ) : (
                <Tooltip title={name} placement="right">
                    {header}
                </Tooltip>
            )}
            <Collapse in={isOpen} timeout="auto" unmountOnExit>
                <List
                    dense={dense}
                    component="div"
                    disablePadding
                    className={
                        sidebarIsOpen
                            ? classes.sidebarIsOpen
                            : classes.sidebarIsClosed
                    }
                >
                    {children}
                </List>
            </Collapse>
        </React.Fragment>
    );
};

export default SubMenu;
