import CompanyIcon from '@material-ui/icons/SupervisedUserCircle';
import CompanyList from './CompanyList';
import CompanyCreate from './CompanyCreate';
import CompanyShow from './CompanyShow';

export default {
  name: 'companies',
  icon: CompanyIcon,
  list: CompanyList,
  create: CompanyCreate,
  show: CompanyShow,
  options: {
    label: 'Empresas'
  }
}
