import UsersList from './UsersList';
import CreateUser from './CreateUser'
import PeopleOutlineIcon from '@material-ui/icons/PeopleOutline';

export default {
  name: 'users',
  icon: PeopleOutlineIcon,
  list: UsersList,
  create: CreateUser,
  options: {
    label: 'Usuarios'
  }
}
