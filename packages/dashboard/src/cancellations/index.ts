import * as React from 'react';
import DeleteSweepIcon from '@material-ui/icons/DeleteSweep';
import CancellationsList from './List';

export default {
  name: 'cancellations',
  icon: DeleteSweepIcon,
  list: CancellationsList,
  options: {
    label: 'Anulaciones'
  }
}