import Button from '@material-ui/core/Button';
import { makeStyles } from '@material-ui/core';
import LogoutIcon from '@material-ui/icons/Lock';
import { useUserDispatch } from '../hooks/useUserState'
import { useHistory } from 'react-router-dom'
import { axios } from '@sauco/lib/providers'

const useStyles = makeStyles(theme => ({
    button: {
        textTransform: 'none',
        fontSize: '16px',
        borderRadius: '6px',
        boxShadow: 'none',
        color: theme.palette.error.main,
        marginLeft: '10px'
    }
}));

const LogoutButton = ({ children }) => {
    const classes = useStyles();
    const { unsetUser } = useUserDispatch();
    const history = useHistory()

    const handleClick = async () => {
        const res = await axios.get('/logout')

        if (res.status >= 200 && res.status <= 400) {
            await unsetUser();
            await history.push('/login');
        }
    }

    return (
        <Button
            startIcon={<LogoutIcon />}
            className={classes.button}
            onClick={() => handleClick()}
        >
            {children}
        </Button>
    )
}

export default LogoutButton
