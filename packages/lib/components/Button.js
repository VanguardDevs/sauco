import Button from '@material-ui/core/Button';
import CircularProgress from '@material-ui/core/CircularProgress';
import { makeStyles } from '@material-ui/core';
import { fade } from '@material-ui/core/styles/colorManipulator';
import Typography from '@material-ui/core/Typography';
import { useMediaQuery } from '@material-ui/core';
import Fab from '@material-ui/core/Fab';
import PlusIcon from '@material-ui/icons/Add'

const useStyles = makeStyles(theme => ({
    loader: {
        margin: '0.36rem'
    },
    floating: {
        color: theme.palette.getContrastText(theme.palette.secondary.main),
        margin: 0,
        top: 'auto',
        right: 20,
        bottom: 60,
        left: 'auto',
        position: 'fixed',
        zIndex: 1000,
        '&:hover': {
            boxShadow: `0px 2px 2px -2px ${theme.palette.primary.main}`,
            backgroundColor: fade(theme.palette.secondary.main, 0.95)
        }
    },
    button: {
        textTransform: 'none',
        fontSize: '16px',
        borderRadius: '6px',
        boxShadow: 'none',
        maxHeight: '2.5rem !important',
        width: props => props.fullWidth ? '100%' : 'max-content',
        minWidth: '8rem',
        '&:hover': {
            boxShadow: `0px 2px 2px -2px ${theme.palette.primary.main}`,
            backgroundColor: fade(theme.palette.secondary.main, 0.95)
        }
    }
}));

const CustomButton = ({ disabled, children, fullWidth, unresponsive, icon, ...rest }) => {
    const classes = useStyles({
        fullWidth: fullWidth
    });
    const isSmall = useMediaQuery(theme =>
        theme.breakpoints.down('sm')
    );

    if (isSmall && !unresponsive) {
        return (
            <Fab
                variant='contained'
                color='secondary'
                type="submit"
                className={classes.floating}
                disabled={disabled}
                {...rest}
            >
                {icon}
            </Fab>
        )
    }

    const FullWidthButton = () => (
        <Button
            className={classes.button}
            disabled={disabled}
            {...rest}
        >
            {(!disabled)
                ? <Typography variant="subtitle1">
                    {children}
                </Typography>
                : <CircularProgress className={classes.loader} size={'1rem'} />
            }
        </Button>
    )

    return <FullWidthButton />
}

CustomButton.defaultProps = {
    disabled: false,
    unresponsive: false,
    variant: 'contained',
    color: 'secondary',
    type: 'submit',
    icon: <PlusIcon />,
    fullWidth: false
}

export default CustomButton
