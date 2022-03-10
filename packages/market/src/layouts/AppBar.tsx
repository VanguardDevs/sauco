import { forwardRef } from 'react';
import { AppBar, UserMenu, MenuItemLink } from 'react-admin';
import Typography from '@material-ui/core/Typography';
import Box from '@material-ui/core/Box';
import SecurityIcon from '@material-ui/icons/Security';
import AccountBoxIcon from '@material-ui/icons/AccountBox';
import { makeStyles } from '@material-ui/core';

const useStyles = makeStyles({
    title: {
        flex: 1,
        textOverflow: 'ellipsis',
        whiteSpace: 'nowrap',
        overflow: 'hidden',
    },
    spacer: {
        flex: 1,
    },
});

const CustomUserMenu = forwardRef<any, any>((props, ref) => (
    <UserMenu {...props}>
        <Box>
            <MenuItemLink
                ref={ref}
                to="/profile"
                primaryText='Perfil'
                title='Configuraciones de perfil'
                leftIcon={<AccountBoxIcon />}
                onClick={props.onClick}
                sidebarIsOpen
            />
            <MenuItemLink
                ref={ref}
                to="/security"
                primaryText='Seguridad'
                title='Configuraciones de seguridad'
                leftIcon={<SecurityIcon />}
                onClick={props.onClick}
                sidebarIsOpen
            />
        </Box>
    </UserMenu>
));

const CustomAppBar = (props: any) => {
    const classes = useStyles();

    return (
        <AppBar {...props} elevation={1} userMenu={<CustomUserMenu />}>
            <Typography
                variant="h6"
                color="inherit"
                className={classes.title}
                id="react-admin-title"
            />
            <span className={classes.spacer} />
        </AppBar>
    );
};

export default CustomAppBar;
