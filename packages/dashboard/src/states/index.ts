import StatesList from './StatesList'
import ExploreIcon from '@material-ui/icons/Explore';
import StateCreate from './StateCreate'
import StateEdit from './StateEdit'

export default {
  name: 'states',
  icon: ExploreIcon,
  list: StatesList,
  create: StateCreate,
  edit: StateEdit,
  options: {
    label: 'Estados'
  }
}
