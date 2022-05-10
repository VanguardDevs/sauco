import * as React from 'react';
import MenuItemLink from '@sauco/lib/components/MenuItemLink';
import SubMenu from './SubMenu';

import HomeIcon from '@material-ui/icons/Home';
import ColorLensIcon from '@material-ui/icons/ColorLens';
import LocalOfferIcon from '@material-ui/icons/LocalOffer';
import DriveEtaIcon from '@material-ui/icons/DriveEta';
import SettingsIcon from '@material-ui/icons/Settings';
import RoomIcon from '@material-ui/icons/Room';
import AirportShuttleIcon from '@material-ui/icons/AirportShuttle';

import ClearAllIcon from '@material-ui/icons/ClearAll';
import StyleIcon from '@material-ui/icons/Style';

import { makeStyles } from '@material-ui/core/styles';
import { fade } from '@material-ui/core';

const useStyles = makeStyles((theme) => ({
    root: {
        width: '100%',
        color: theme.palette.primary.light,
        fill: theme.palette.primary.light,
        stroke: theme.palette.primary.light,
        borderRadius: '6px',
        marginTop: '0.15rem',
        alignItems: 'center',
        backgroundColor: fade(theme.palette.primary.light),

      },
    nested: {
        minWidth: theme.spacing(4),
    },
    active: {
        borderLeft: `3px solid ${theme.palette.secondary.main}`,
        backgroundColor: fade(theme.palette.secondary.main, 0.16),
        color: theme.palette.secondary.main,
        fill: theme.palette.secondary.main,
        stroke: theme.palette.secondary.main
    },
}));

export default function MenuItems({ open, onMenuClick, dense }) {
    const classes = useStyles();
    const [state, setState] = React.useState({
        people: false,
        reports: false,
        settings: false,
        administration: false,
        cadastre: false,
        rates: false
    });
    const handleToggle = menu => {
        setState(state => ({ ...state, [menu]: !state[menu] }));
    };

    return (
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
            <SubMenu
                handleToggle={() => handleToggle('rates')}
                isOpen={state.rates}
                sidebarIsOpen={open}
                name="Tasas"
                icon={<SettingsIcon />}
                dense={dense}
            >
            </SubMenu>
            <SubMenu
                handleToggle={() => handleToggle('reports')}
                isOpen={state.reports}
                sidebarIsOpen={open}
                name="Reportes"
                icon={<SettingsIcon />}
                dense={dense}
            >
            </SubMenu>
            <SubMenu
                handleToggle={() => handleToggle('cadastre')}
                isOpen={state.cadastre}
                sidebarIsOpen={open}
                name="Áreas"
                icon={<SettingsIcon />}
                dense={dense}
            >
            </SubMenu>
            <SubMenu
                handleToggle={() => handleToggle('settings')}
                isOpen={state.settings}
                sidebarIsOpen={open}
                name="Configuraciones"
                icon={<SettingsIcon />}
                dense={dense}
            >
                <MenuItemLink
                    className={classes.nested}
                    to="/colors"
                    primaryText='Colores'
                    leftIcon={<ColorLensIcon />}
                    onClick={onMenuClick}
                    sidebarIsOpen={open}
                    dense={dense}
                    exact
                />
                <MenuItemLink
                    className={classes.nested}
                    to="/signatures"
                    primaryText='Firmas'
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
                    to="/vehicle-models"
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
                    leftIcon={<AirportShuttleIcon />}
                    onClick={onMenuClick}
                    sidebarIsOpen={open}
                    dense={dense}
                    exact
                />

                <MenuItemLink
                    to="/vehicle-parameters"
                    primaryText='Parametros'
                    leftIcon={<DriveEtaIcon />}
                    onClick={onMenuClick}
                    sidebarIsOpen={open}
                    dense={dense}
                    exact
                />


                <MenuItemLink
                    to="/liqueur-zones"
                    primaryText='Zonas'
                    leftIcon={<RoomIcon />}
                    onClick={onMenuClick}
                    sidebarIsOpen={open}
                    dense={dense}
                    exact
                />

                <MenuItemLink
                    to="/liqueur-annexes"
                    primaryText='Anexos'
                    leftIcon={<StyleIcon />}
                    onClick={onMenuClick}
                    sidebarIsOpen={open}
                    dense={dense}
                    exact
                />

                <MenuItemLink
                    to="/liqueur-classifications"
                    primaryText='Clasificaciones'
                    leftIcon={<ClearAllIcon />}
                    onClick={onMenuClick}
                    sidebarIsOpen={open}
                    dense={dense}
                    exact
                />

                <MenuItemLink
                    to="/liqueur-parameters"
                    primaryText='Parametros'
                    leftIcon={<SettingsIcon />}
                    onClick={onMenuClick}
                    sidebarIsOpen={open}
                    dense={dense}
                    exact
                />
                <MenuItemLink
                    to="/years"
                    primaryText='Años'
                    leftIcon={<ColorLensIcon />}
                    onClick={onMenuClick}
                    sidebarIsOpen={open}
                    dense={dense}
                    exact
                />
                <MenuItemLink
                    to="/status"
                    primaryText='Estado de movimientos'
                    leftIcon={<ColorLensIcon />}
                    onClick={onMenuClick}
                    sidebarIsOpen={open}
                    dense={dense}
                    exact
                />
                <MenuItemLink
                    to="/liquidation-types"
                    primaryText='Tipos de liquidación'
                    leftIcon={<ColorLensIcon />}
                    onClick={onMenuClick}
                    sidebarIsOpen={open}
                    dense={dense}
                    exact
                />
                <MenuItemLink
                    to="/payment-types"
                    primaryText='Tipos de pago'
                    leftIcon={<ColorLensIcon />}
                    onClick={onMenuClick}
                    sidebarIsOpen={open}
                    dense={dense}
                    exact
                />
                <MenuItemLink
                    to="/ordinances"
                    primaryText='Ordenanzas'
                    leftIcon={<ColorLensIcon />}
                    onClick={onMenuClick}
                    sidebarIsOpen={open}
                    dense={dense}
                    exact
                />
            </SubMenu>
            <SubMenu
                handleToggle={() => handleToggle('administration')}
                isOpen={state.administration}
                sidebarIsOpen={open}
                name="Personal"
                icon={<SettingsIcon />}
                dense={dense}
            >
            </SubMenu>
        </React.Fragment>
    )
};
