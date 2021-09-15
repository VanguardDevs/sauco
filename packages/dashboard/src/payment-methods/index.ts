import PaymentMethodsList from './List';
import PaymentIcon from '@material-ui/icons/Payment';

export default {
  name: 'payment-methods',
  icon: PaymentIcon,
  list: PaymentMethodsList,
  options: {
    label: 'Métodos de pago'
  }
}
