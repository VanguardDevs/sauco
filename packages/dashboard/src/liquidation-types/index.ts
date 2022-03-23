import LiquidationTypesList from './LiquidationTypesList'
import LiquidationTypeCreate from './LiquidationTypeCreate'
import LiquidationTypeEdit from './LiquidationTypeEdit'
import DescriptionIcon from '@material-ui/icons/Description';

export default {
    name: 'liquidation-types',
    icon: DescriptionIcon,
    list: LiquidationTypesList,
    edit: LiquidationTypeEdit,
    create: LiquidationTypeCreate,
    options: {
        label: 'Tipos de liquidaciones'
    }
}
