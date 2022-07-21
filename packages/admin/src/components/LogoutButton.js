import * as React from 'react';
import ListItemText from '@mui/material/ListItemText';
import ListItemIcon from '@mui/material/ListItemIcon';
import Logout from '@mui/icons-material/Logout';
import ListItem from '@mui/material/ListItem';
import axios from '../api'
import { useAuth, logout } from '../context/AuthContext'
import { useNavigate } from 'react-router-dom';

export default function LogoutButton() {
    const { dispatch } = useAuth();
    const navigate = useNavigate();

    const handleClick = React.useCallback(async () => {
        try {
            logout(dispatch);
            navigate('/login', { replace: true })
            await axios.get('/logout')
        } catch (e) {
            console.log(e)
        }
    }, [])

    return (
        <ListItem button onClick={handleClick}>
            <ListItemIcon sx={{ color: theme => theme.palette.error.main }}>
                <Logout />
            </ListItemIcon>
            <ListItemText
                primary='Cerrar sesión'
                sx={{ color: theme => theme.palette.error.main }}
            />
        </ListItem>
    );
}