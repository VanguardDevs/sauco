import PermissionsList from './PermissionsList'
import AccessibilityIcon from '@material-ui/icons/Accessibility'
import PermissionCreate from './PermissionCreate'
import PermissionEdit from './PermissionEdit'

export default {
  name: 'permissions',
  icon: AccessibilityIcon,
  list: PermissionsList,
  create: PermissionCreate,
  edit: PermissionEdit,
  options: {
    label: 'Permisos'
  }
}
