import * as React from 'react';
import TimelineIcon from '@material-ui/icons/Timeline';
import PaymentsList from './List';

export default {
  name: 'payments',
  icon: TimelineIcon,
  list: PaymentsList,
  options: {
    label: 'Facturas'
  }
}