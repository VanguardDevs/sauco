import * as React from 'react'
import {
    makeStyles,
    Toolbar,
    useMediaQuery,
    Box,
    AppBar as MuiAppBar
} from '@material-ui/core';
// Icons
import ToggleSidebarButton from './ToggleSidebarButton';
import GoBackButton from './GoBackButton';
import { useSelector } from 'react-redux';
import UserMenu from './UserMenu'
import { MenuItemLink } from 'react-admin'
import ProfileIcon from '@material-ui/icons/AccountBox';
import LogoutButton from '../components/LogoutButton'
import Typography from '@material-ui/core/Typography'
import { useUserState } from '../hooks/useUserState'
import Dot from '../components/Dot'

const useStyles = makeStyles(theme => ({
        root: {
            backgroundColor: props =>
                props.isXSmall ? theme.palette.primary.main
                : theme.palette.background.default,
            width: props =>
                props.fullWidth ? '100%'
                : !props.isOpenSidebar && (!props.isXSmall) // Large screens
                    ? `calc(100% - 55px)`
                : (props.isXSmall) // Small screen
                    ? '100%'
                : `calc(100% - 240px)`, // Large screen
            boxShadow: 'none',
            borderBottom: 0,
            transition: 'width 195ms cubic-bezier(0.4, 0, 0.6, 1) 0ms'
        },
        toolbar: {
            display: 'flex',
            justifyContent: 'space-between',
            paddingRight: 24,
            backgroundColor: 'transparent',
            flexDirection: props =>
                props.isXSmall
                    ? 'row-reverse'
                    : 'row',
        },
        title: {
            flex: 1,
            textOverflow: 'ellipsis',
            whiteSpace: 'nowrap',
            overflow: 'hidden',
        },
        gameinfo: {
            fontWeight: 600,
            display: 'flex',
            alignItems: 'center',
            color: theme.palette.primary.main,
            padding: '0 1rem'
        }
    }),
    { name: 'RaAppBar' }
);

const CustomUserMenu = React.forwardRef((props, ref) => (
    <UserMenu {...props}>
        <Box color='primary'>
            <MenuItemLink
                ref={ref}
                to="/profile"
                primaryText='Perfil'
                title='Configuraciones de perfil'
                leftIcon={<ProfileIcon color='inherit' />}
                onClick={props.onClick}
                sidebarIsOpen
            />
            <LogoutButton>
                <Typography variant="subtitle1">
                    {'Cerrar sesión'}
                </Typography>
            </LogoutButton>
        </Box>
    </UserMenu>
));

const AppBar = props => {
    const { selected } = props
    const isXSmall = useMediaQuery(theme =>
        theme.breakpoints.down('xs')
    );
    const open = useSelector(state => state.admin.ui.sidebarOpen);
    const classes = useStyles({
        isOpenSidebar: open,
        isXSmall: isXSmall,
        fullWidth: selected
    });
    const { user } = useUserState();

    return (
        <MuiAppBar className={classes.root} position='absolute' {...props} title=''>
            <Toolbar
                disableGutters
                variant={isXSmall ? 'regular' : 'dense'}
                className={classes.toolbar}
            >
                <Box display='flex'>
                    {!selected && <ToggleSidebarButton />}
                    <GoBackButton />
                    {(selected) && (
                        <Box className={classes.gameinfo}>
                            Trivia <Dot /> Derecho Laboral
                        </Box>
                    )}
                </Box>

                <div style={{ display: 'flex' }}>
                    <CustomUserMenu />
                </div>
            </Toolbar>
        </MuiAppBar>
    );
};

AppBar.defaultsProps = {
    fullWidth: false,
    selected: true
}

export default AppBar;
