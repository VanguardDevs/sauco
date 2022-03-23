import TaxpayerIcon from '@material-ui/icons/SupervisedUserCircle';
import TaxpayersList from './TaxpayersList';
import TaxpayerCreate from './TaxpayersCreate';
import TaxpayerShow from './TaxpayerShow';

export default {
  name: 'taxpayers',
  icon: TaxpayerIcon,
  list: TaxpayersList,
  create: TaxpayerCreate,
  show: TaxpayerShow,
  options: {
    label: 'Contribuyentes'
  }
}
