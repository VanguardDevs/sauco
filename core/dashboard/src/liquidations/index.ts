import * as React from 'react';
import LiquidationsList from './List';
import BallotIcon from '@material-ui/icons/Ballot';

export default {
  name: 'liquidations',
  icon: BallotIcon,
  list: LiquidationsList,
  options: {
    label: 'Liquidaciones'
  }
}