import * as React from 'react';
import OrdinancesList from './List';
import AttachFileIcon from '@material-ui/icons/AttachFile';

export default {
  name: 'ordinances',
  icon: AttachFileIcon,
  list: OrdinancesList,
  options: {
    label: 'Ordenanzas'
  }
}
