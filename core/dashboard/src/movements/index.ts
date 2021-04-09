import * as React from 'react';
import ContactMailIcon from '@material-ui/icons/ContactMail';
import MovementsList from './List';

export default {
  name: 'movements',
  icon: ContactMailIcon,
  list: MovementsList,
  options: {
    label: 'Movimientos'
  }
}