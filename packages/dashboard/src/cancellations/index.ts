import DeleteSweepIcon from '@material-ui/icons/DeleteSweep';
import CancellationsList from './CancellationList';
import CancellationShow from './CancellationShow';

export default {
    name: 'cancellations',
    icon: DeleteSweepIcon,
    list: CancellationsList,
    show: CancellationShow,
    options: {
        label: 'Anulaciones'
    }
}
