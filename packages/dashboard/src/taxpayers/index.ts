import TaxpayerIcon from '@material-ui/icons/SupervisedUserCircle';
import TaxpayersList from './TaxpayersList';
import TaxpayerCreate from './TaxpayersCreate';

export default {
  name: 'taxpayers',
  icon: TaxpayerIcon,
  list: TaxpayersList,
  create: TaxpayerCreate,
  options: {
    label: 'Contribuyentes'
  }
}
