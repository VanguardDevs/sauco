import PaymentTypesList from './PaymentTypesList';
import PaymentIcon from '@material-ui/icons/Payment';
import PaymentTypeCreate from './PaymentTypesCreate';
import PaymentTypeEdit from './PaymenTypeEdit';

export default {
  name: 'payment-types',
  icon: PaymentIcon,
  list: PaymentTypesList,
  create: PaymentTypeCreate,
  edit: PaymentTypeEdit,
  options: {
    label: 'Tipos de pago'
  }
}
