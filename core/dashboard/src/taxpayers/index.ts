import * as React from 'react';
import TaxpayerIcon from '@material-ui/icons/SupervisedUserCircle';
import TaxpayersList from './List';

export default {
  name: 'taxpayers',
  icon: TaxpayerIcon,
  list: TaxpayersList,
  options: {
    label: 'Conribuyentes'
  }
}
