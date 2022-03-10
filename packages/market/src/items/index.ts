import ItemsList from './ItemsList'
import ItemsCreate from './ItemsCreate'
import ItemsEdit from './ItemsEdit'
import ShoppingBasketIcon from '@material-ui/icons/ShoppingBasket';

export default {
    name: 'items',
    icon: ShoppingBasketIcon,
    list: ItemsList,
    edit: ItemsEdit,
    create: ItemsCreate,
    options: {
        label: 'Rubros'
    }
}
