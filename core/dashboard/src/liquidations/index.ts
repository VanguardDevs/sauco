import * as React from 'react';
import ContactMailIcon from '@material-ui/icons/ContactMail';
import LiquidationsList from './List';

export default {
  name: 'liquidations',
  icon: ContactMailIcon,
  list: LiquidationsList,
  options: {
    label: 'Liquidaciones'
  }
}