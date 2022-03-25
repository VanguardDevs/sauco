import * as React from 'react';
import MenuItemLink from '@sauco/lib/components/MenuItemLink';
import SubMenu from './SubMenu';


import HomeIcon from '@material-ui/icons/Home';
import ColorLensIcon from '@material-ui/icons/ColorLens';
import LocalOfferIcon from '@material-ui/icons/LocalOffer';
import DriveEtaIcon from '@material-ui/icons/DriveEta';
import SettingsIcon from '@material-ui/icons/Settings';
import ClearAllIcon from '@material-ui/icons/ClearAll';
import StyleIcon from '@material-ui/icons/Style';

import { makeStyles } from '@material-ui/core/styles';
import { fade, useMediaQuery } from '@material-ui/core';

import List from '@material-ui/core/List';
import ListItem from '@material-ui/core/ListItem';
import ListItemIcon from '@material-ui/core/ListItemIcon';
import ListItemText from '@material-ui/core/ListItemText';
import Collapse from '@material-ui/core/Collapse';
import ExpandLess from '@material-ui/icons/ExpandLess';
import ExpandMore from '@material-ui/icons/ExpandMore';



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




// const MenuItems = ({ open, onMenuClick, dense }) => (
export default function MenuItems({ open, onMenuClick, dense }) {
    const classes = useStyles();
    const [openList, setOpen] = React.useState(true);
    const handleClick = () => {
        setOpen(!openList);
    };

    const [state, setState] = React.useState({
        people: true,
        reports: false,
        settings: false,
        administration: false,
        cadastre: false,
        rates: false,
        env: process.env.REACT_APP_ENV
    });
    const isXSmall = useMediaQuery(theme =>
        theme.breakpoints.down('xs')
    );

    const handleToggle = (menu) => {
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
                    leftIcon={<ClearAllIcon />}
                    onClick={onMenuClick}
                    sidebarIsOpen={open}
                    dense={dense}
                    exact
                />

                <MenuItemLink
                    to="/vehicle-parameters"
                    primaryText='Parametros'
                    leftIcon={<SettingsIcon />}
                    onClick={onMenuClick}
                    sidebarIsOpen={open}
                    dense={dense}
                    exact
                />
            </SubMenu>
        </React.Fragment>
    )
};
