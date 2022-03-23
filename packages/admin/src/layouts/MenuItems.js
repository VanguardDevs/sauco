import * as React from 'react';
import MenuItemLink from '@sauco/lib/components/MenuItemLink'
import HomeIcon from '@material-ui/icons/Home';
import InvertColorsRoundedIcon from '@material-ui/icons/InvertColorsRounded';

const MenuItems = ({ open, onMenuClick, dense }) => (
    <React.Fragment>
        <MenuItemLink
            to="/"
            primaryText='Inicio'
            leftIcon={<HomeIcon />}
            onClick={onMenuClick}
            sidebarIsOpen={open}
            dense={dense}
            exact
        />
        <MenuItemLink
            to="/colors"
            primaryText='Colores'
            leftIcon={<InvertColorsRoundedIcon />}
            onClick={onMenuClick}
            sidebarIsOpen={open}
            dense={dense}
            exact
        />
    </React.Fragment>
);

export default MenuItems;
