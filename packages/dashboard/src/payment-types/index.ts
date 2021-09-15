import PaymentTypesList from './List';
import PaymentIcon from '@material-ui/icons/Payment';

export default {
  name: 'payment-types',
  icon: PaymentIcon,
  list: PaymentTypesList,
  options: {
    label: 'Tipos de pago'
  }
}
