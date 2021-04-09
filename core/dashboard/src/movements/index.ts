import * as React from 'react';
import MovementsList from './List';
import CompareArrowsIcon from '@material-ui/icons/CompareArrows';

export default {
  name: 'movements',
  icon: CompareArrowsIcon,
  list: MovementsList,
  options: {
    label: 'Movimientos'
  }
}