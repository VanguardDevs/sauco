import * as React from 'react';
import MenuItemLink from '@sauco/lib/components/MenuItemLink'
import HomeIcon from '@material-ui/icons/Home';
import ColorLensIcon from '@material-ui/icons/ColorLens';
import LocalOfferIcon from '@material-ui/icons/LocalOffer';
import DriveEtaIcon from '@material-ui/icons/DriveEta';
import SettingsIcon from '@material-ui/icons/Settings';
import ClearAllIcon from '@material-ui/icons/ClearAll';
import StyleIcon from '@material-ui/icons/Style';

import { makeStyles } from '@material-ui/core/styles';
import { fade } from '@material-ui/core';

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


    <List component="nav" className={classes.root}>
        <ListItem button onClick={handleClick}>

          <SettingsIcon />
        <ListItemText primary="Configuraciones" />
        {openList ? <ExpandLess /> : <ExpandMore />}
      </ListItem>
      <Collapse in={openList} timeout="auto" unmountOnExit>
        <List component="div" disablePadding >

          <ListItem >
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
        </ListItem>

        <ListItem>
        <MenuItemLink
            to="/brands"
            primaryText='Marcas'
            leftIcon={<LocalOfferIcon />}
            onClick={onMenuClick}
            sidebarIsOpen={open}
            dense={dense}
            exact
        />
        </ListItem>

        <ListItem>
        <MenuItemLink
            to="/models"
            primaryText='Modelos'
            leftIcon={<StyleIcon />}
            onClick={onMenuClick}
            sidebarIsOpen={open}
            dense={dense}
            exact
        />
        </ListItem>

        <ListItem>
        <MenuItemLink
            to="/vehicle-classifications"
            primaryText='Clasificaciones'
            leftIcon={<ClearAllIcon />}
            onClick={onMenuClick}
            sidebarIsOpen={open}
            dense={dense}
            exact
        />
        </ListItem>

        <ListItem>
        <MenuItemLink
            to="/vehicle-parameters"
            primaryText='Parametros'
            leftIcon={<SettingsIcon />}
            onClick={onMenuClick}
            sidebarIsOpen={open}
            dense={dense}
            exact
        />
          </ListItem>
        </List>
      </Collapse>
    </List>

    </React.Fragment>
)};
