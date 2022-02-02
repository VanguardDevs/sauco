import * as React from 'react';
import { useSelector } from 'react-redux';
import { useMediaQuery, Theme, Box } from '@material-ui/core';
import {
    MenuProps,
} from 'react-admin';
import { AppState } from '@sauco/common/types';
import MenuItemLink from './MenuItemLink'
// Menu icons
import DashboardIcon from '@material-ui/icons/Dashboard';
// Resources
import items from '../items';

const Menu: React.FC<MenuProps> = ({ onMenuClick, logout, dense = false }) => {
    const isXSmall = useMediaQuery((theme: Theme) =>
        theme.breakpoints.down('xs')
    );
    const open = useSelector((state: AppState) => state.admin.ui.sidebarOpen);

    return (
        <Box mt={1}>
            {' '}
            <MenuItemLink
                to="/"
                primaryText={open ? 'Inicio' : <></>}
                leftIcon={<DashboardIcon />}
                onClick={onMenuClick}
                sidebarIsOpen={open}
                dense={dense}
                exact
            />
            <MenuItemLink
                to={'/'+items.name}
                primaryText={items.options.label}
                leftIcon={<items.icon />}
                onClick={onMenuClick}
                sidebarIsOpen={open}
                dense={dense}
            />
            {isXSmall && logout}
        </Box>
    );
};

export default Menu;
