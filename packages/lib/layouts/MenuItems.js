import * as React from 'react';
import MenuItemLink from '../components/MenuItemLink'
import LogoutButton from '../components/LogoutButton'
import Typography from '@material-ui/core/Typography'
import HomeIcon from '@material-ui/icons/Home';
import PublicIcon from '@material-ui/icons/Public';
import LocalOfferIcon from '@material-ui/icons/LocalOffer';
import TelegramIcon from '@material-ui/icons/Telegram';

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
            to='/communities'
            primaryText='Comunidades'
            leftIcon={<PublicIcon />}
            onClick={onMenuClick}
            sidebarIsOpen={open}
            dense={dense}
        />
        <MenuItemLink
            to='/categories'
            primaryText='Categorías'
            leftIcon={<LocalOfferIcon />}
            onClick={onMenuClick}
            sidebarIsOpen={open}
            dense={dense}
        />
        <MenuItemLink
            to='/applications'
            primaryText='Solicitudes'
            leftIcon={<TelegramIcon />}
            onClick={onMenuClick}
            sidebarIsOpen={open}
            dense={dense}
        />
        <LogoutButton>
            {open && (
                <Typography variant="subtitle1">
                    {'Cerrar sesión'}
                </Typography>
            )}
        </LogoutButton>
    </React.Fragment>
);

export default MenuItems;
