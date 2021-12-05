import SignatureIcon from '@material-ui/icons/SupervisedUserCircle';
import SignatureList from './SignatureList';
import SignatureCreate from './SignatureCreate';
import SignatureEdit from './SignatureEdit';

export default {
    name: 'signatures',
    icon: SignatureIcon,
    edit: SignatureEdit,
    list: SignatureList,
    create: SignatureCreate,
    options: {
        label: 'Firmas'
    }
}
