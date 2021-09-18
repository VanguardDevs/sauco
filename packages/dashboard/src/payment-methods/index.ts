import PaymentMethodsList from './PaymentMethodList';
import PaymentIcon from '@material-ui/icons/Payment';
import PaymentMethodCreate from './PaymentMethodCreate';
import PaymentMethodEdit from './PaymentMethodEdit';

export default {
  name: 'payment-methods',
  icon: PaymentIcon,
  list: PaymentMethodsList,
  edit: PaymentMethodEdit,
  create: PaymentMethodCreate,
  options: {
    label: 'Métodos de pago'
  }
}
