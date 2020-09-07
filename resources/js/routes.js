import React from 'react';
import HomeWorkIcon from '@material-ui/icons/HomeWork';
import BusinessCenterIcon from '@material-ui/icons/BusinessCenter';
import DashboardIcon from '@material-ui/icons/Dashboard';
import PublicIcon from '@material-ui/icons/Public';
import SettingsIcon from '@material-ui/icons/Settings';
import NoteIcon from '@material-ui/icons/Note';

const routes = [
  {
    path: '/home',
    name: 'Inicio',
    icon: <DashboardIcon />
  },
  {
    path: '/taxpayers',
    name: 'Contribuyentes',
    icon: <BusinessCenterIcon /> 
  }, 
  {
    path: '/properties',
    name: 'Inmuebles',
    icon: <HomeWorkIcon />
  },
  {
    path: '/licenses',
    name: 'Licencias',
    icon: <NoteIcon /> 
  }, 
  {
    path: '/geographic-area',
    name: 'Área geográfica',
    icon: <PublicIcon />
  },
  {
    path: '/settings',
    name: 'Configuraciones',
    icon: <SettingsIcon /> 
  }
];

export default routes; 

