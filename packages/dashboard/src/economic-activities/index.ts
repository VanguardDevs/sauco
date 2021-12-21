import EconomicActivitiesList from './EconomicActivitiesList';
import LocalLibraryIcon from '@material-ui/icons/LocalLibrary';
import EconomicActivityCreate from './EconomicActivityCreate';

export default {
  name: 'economic-activities',
  icon: LocalLibraryIcon,
  list: EconomicActivitiesList,
  create: EconomicActivityCreate,
  options: {
    label: 'Actividades económicas'
  }
}
