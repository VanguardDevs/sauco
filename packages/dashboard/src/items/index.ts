import ItemsList from './ItemsList'
import ItemsCreate from './ItemsCreate'
import ItemsEdit from './ItemsEdit'
import PaymentIcon from '@material-ui/icons/Payment';

export default {
    name: 'items',
    icon: PaymentIcon,
    list: ItemsList,
    edit: ItemsEdit,
    create: ItemsCreate,
    options: {
        label: 'Rubros'
    }
}
