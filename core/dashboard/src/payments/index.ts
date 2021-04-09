import * as React from 'react';
import ReceiptIcon from '@material-ui/icons/Receipt';
import PaymentsList from './List';

export default {
  name: 'payments',
  icon: ReceiptIcon,
  list: PaymentsList,
  options: {
    label: 'Facturas'
  }
}