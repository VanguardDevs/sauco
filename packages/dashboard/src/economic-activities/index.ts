import * as React from 'react';
import EconomicActivitiesList from './List';
import LocalLibraryIcon from '@material-ui/icons/LocalLibrary';

export default {
  name: 'economic-activities',
  icon: LocalLibraryIcon,
  list: EconomicActivitiesList,
  options: {
    label: 'Actividades económicas'
  }
}
