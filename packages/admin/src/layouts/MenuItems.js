import * as React from 'react';
import MenuItemLink from '@sauco/lib/components/MenuItemLink'
import HomeIcon from '@material-ui/icons/Home';
import ColorLensIcon from '@material-ui/icons/ColorLens';
import LocalOfferIcon from '@material-ui/icons/LocalOffer';
import StyleIcon from '@material-ui/icons/Style';

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
            leftIcon={<ColorLensIcon />}
            onClick={onMenuClick}
            sidebarIsOpen={open}
            dense={dense}
            exact
        />
        <MenuItemLink
            to="/brands"
            primaryText='Marcas'
            leftIcon={<LocalOfferIcon />}
            onClick={onMenuClick}
            sidebarIsOpen={open}
            dense={dense}
            exact
        />
        <MenuItemLink
            to="/models"
            primaryText='Modelos'
            leftIcon={<StyleIcon />}
            onClick={onMenuClick}
            sidebarIsOpen={open}
            dense={dense}
            exact
        />
        <MenuItemLink
            to="/vehicle-classifications"
            primaryText='Clasificaciones'
            leftIcon={<StyleIcon />}
            onClick={onMenuClick}
            sidebarIsOpen={open}
            dense={dense}
            exact
        />
        <MenuItemLink
            to="/vehicle-parameters"
            primaryText='Parametros'
            leftIcon={<StyleIcon />}
            onClick={onMenuClick}
            sidebarIsOpen={open}
            dense={dense}
            exact
        />
    </React.Fragment>
);

export default MenuItems;
