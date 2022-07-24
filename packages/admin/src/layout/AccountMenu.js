import * as React from 'react';
import Box from '@mui/material/Box';
import Avatar from '@mui/material/Avatar';
import Menu from '@mui/material/Menu';
import ListItemLink from '../components/ListItemLink';
import Button from '@mui/material/Button';
import Tooltip from '@mui/material/Tooltip';
import LockIcon from '@mui/icons-material/Lock';
import LogoutButton from '../components/LogoutButton'
import { useAuth } from '../context/AuthContext'
import CONFIGS from '../configs';

export default function AccountMenu() {
    const { state: { user } } = useAuth();
    const [anchorEl, setAnchorEl] = React.useState(null);
    const open = Boolean(anchorEl);
    const handleClick = (event) => {
        setAnchorEl(event.currentTarget);
    };
    const handleClose = () => {
        setAnchorEl(null);
    };

    return (
        <React.Fragment>
        <Box sx={{ display: 'flex', alignItems: 'center', textAlign: 'center' }}>
            <Tooltip title="Mi cuenta">
                <Button
                    onClick={handleClick}
                    size="small"
                    sx={{ ml: 2 }}
                    aria-controls={open ? 'account-menu' : undefined}
                    aria-haspopup="true"
                    aria-expanded={open ? 'true' : undefined}
                >
                    <Avatar src={`${CONFIGS.BASE}/${user.avatar}`} sx={{
                        width: 32,
                        height: 32,
                        color: theme => theme.palette.primary.main,
                        backgroundColor: '#fff'
                    }} />
                    <Box sx={{
                        color: '#fff',
                        fontWeight: '900',
                        marginLeft: '1rem',
                        fontSize: '1rem',
                        textTransform: 'capitalize'
                    }}>
                        {user.full_name}
                    </Box>
                </Button>

            </Tooltip>
        </Box>
        <Menu
            anchorEl={anchorEl}
            id="account-menu"
            open={open}
            onClose={handleClose}
            onClick={handleClose}
            PaperProps={{
                elevation: 0,
                sx: {
                    overflow: 'visible',
                    filter: 'drop-shadow(0px 2px 8px rgba(0,0,0,0.32))',
                    mt: 1.5,
                    '& .MuiAvatar-root': {
                        width: 32,
                        height: 32,
                        ml: -0.5,
                        mr: 1,
                        },
                        '&:before': {
                        content: '""',
                        display: 'block',
                        position: 'absolute',
                        top: 0,
                        right: 14,
                        width: 10,
                        height: 10,
                        bgcolor: 'background.paper',
                        transform: 'translateY(-50%) rotate(45deg)',
                        zIndex: 0,
                    },
                },
            }}
            transformOrigin={{ horizontal: 'right', vertical: 'top' }}
            anchorOrigin={{ horizontal: 'right', vertical: 'bottom' }}
        >
            <ListItemLink
                primary='Seguridad'
                to='/security'
                icon={<LockIcon fontSize='small' />}
            />
            <LogoutButton />
        </Menu>
        </React.Fragment>
    );
}
