import ParishesList from './ParishesList'
import ParishCreate from './ParishCreate'
import ParishEdit from './ParishEdit'
import AccountBalanceIcon from '@material-ui/icons/AccountBalance';

export default {
  name: 'parishes',
  icon: AccountBalanceIcon,
  list: ParishesList,
  create: ParishCreate,
  edit: ParishEdit,
  options: {
    label: 'Parroquias'
  }
}
