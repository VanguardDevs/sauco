import UsersList from './UsersList';
import CreateUser from './CreateUser'
import PeopleOutlineIcon from '@material-ui/icons/PeopleOutline';
import UserEdit from './UserEdit'

export default {
  name: 'users',
  icon: PeopleOutlineIcon,
  list: UsersList,
  edit: UserEdit,
  create: CreateUser,
  options: {
    label: 'Usuarios'
  }
}
