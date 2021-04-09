import * as React from 'react';
import BallotIcon from '@material-ui/icons/Ballot';
import MovementsList from './List';

export default {
  name: 'movements',
  icon: BallotIcon,
  list: MovementsList,
  options: {
    label: 'Movimientos'
  }
}