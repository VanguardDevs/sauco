import EconomicActivitiesList from './EconomicActivitiesList';
import LocalLibraryIcon from '@material-ui/icons/LocalLibrary';
import EconomicActivityCreate from './EconomicActivityCreate';
import EconomicActivityShow from './EconomicActivityShow';

export default {
  name: 'economic-activities',
  icon: LocalLibraryIcon,
  list: EconomicActivitiesList,
  create: EconomicActivityCreate,
  show: EconomicActivityShow,
  options: {
    label: 'Actividades económicas'
  }
}
