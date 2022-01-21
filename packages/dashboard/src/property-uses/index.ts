import PropertyUseList from './PropertyUseList';
import AttachFileIcon from '@material-ui/icons/AttachFile';
import PropertyUseCreate from './PropertyUseCreate';
import PropertyUseEdit from './PropertyUseEdit';

export default {
  name: 'property-uses',
  icon: AttachFileIcon,
  list: PropertyUseList,
  create: PropertyUseCreate,
  edit: PropertyUseEdit,
  options: {
    label: 'Usos de inmuebles'
  }
}
