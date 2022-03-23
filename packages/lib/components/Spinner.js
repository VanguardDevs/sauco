import { withStyles } from '@material-ui/core/styles';
import Box from '@material-ui/core/Box';
import CircularProgress from '@material-ui/core/CircularProgress';
import clsx from 'clsx';

const styles = {
    root: {
        display: 'flex',
        height: '100%',
        justifyContent: 'center',
        alignItems: 'center',
        backgroundColor: 'transparent',
        width: '100%'
    },
    loader: {
        height: '5em !important',
        width: '5em !important',
        color: '#2280ED'
    }
};

const Spinner = ({ root, classes, loader }) => (
    <Box className={clsx(root, classes.root )}>
        <CircularProgress className={clsx(classes.loader, loader )}/>
    </Box>
);

export default withStyles(styles)(Spinner);
