import TimelineIcon from '@material-ui/icons/Timeline';
import PetroPricesList from './PetroPricesList';
import PetroPriceCreate from './PetroPriceCreate';

export default {
  name: 'petro-prices',
  icon: TimelineIcon,
  create: PetroPriceCreate,
  list: PetroPricesList,
  options: {
    label: 'Valores del petro'
  }
}
