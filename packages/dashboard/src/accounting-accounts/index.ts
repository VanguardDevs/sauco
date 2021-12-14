import AccountingAccountIcon from '@material-ui/icons/AccountBalanceWallet';
import AccountingAccountList from './AccountingAccountList';
import AccountingAccountCreate from './AccountingAccountCreate';
import AccountingAccountEdit from './AccountingAccountEdit';

export default {
    name: 'accounting-accounts',
    icon: AccountingAccountIcon,
    edit: AccountingAccountEdit,
    list: AccountingAccountList,
    create: AccountingAccountCreate,
    options: {
        label: 'Cuentas contables'
    }
}
