import OrdinancesList from './OrdinanceList';
import AttachFileIcon from '@material-ui/icons/AttachFile';
import OrdinanceCreate from './OrdinanceCreate';
import OrdinanceEdit from './OrdinanceEdit';

export default {
  name: 'ordinances',
  icon: AttachFileIcon,
  list: OrdinancesList,
  create: OrdinanceCreate,
  edit: OrdinanceEdit,
  options: {
    label: 'Ordenanzas'
  }
}
