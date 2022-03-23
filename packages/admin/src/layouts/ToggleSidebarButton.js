import * as React from 'react';
import {
    Tooltip,
    IconButton,
    styled
} from '@material-ui/core';
import { toggleSidebar } from 'react-admin';
import { useSelector, useDispatch } from 'react-redux';
import MenuIcon from '@material-ui/icons/Menu';

const CustomIconButton = styled(IconButton)(({ theme }) => ({
    color: `${theme.palette.primary.main} !important`,
    marginLeft: '0.5rem'
}));

const ToggleSidebarButton = () => {
    const open = useSelector(state => state.admin.ui.sidebarOpen);
    const dispatch = useDispatch();

    return (
        <Tooltip
            title={open ? 'Cerrar menú' : 'Abrir menú'}
            enterDelay={500}
        >
            <CustomIconButton
                onClick={() => dispatch(toggleSidebar())}
            >
                <MenuIcon />
            </CustomIconButton>
        </Tooltip>
    );
};

export default ToggleSidebarButton;
