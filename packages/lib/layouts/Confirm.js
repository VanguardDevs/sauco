import * as React from 'react';
import PropTypes from 'prop-types';
import Dialog from '@material-ui/core/Dialog';
import DialogActions from '@material-ui/core/DialogActions';
import DialogContent from '@material-ui/core/DialogContent';
import DialogContentText from '@material-ui/core/DialogContentText';
import DialogTitle from '@material-ui/core/DialogTitle';
import Button from '@material-ui/core/Button';
import { makeStyles } from '@material-ui/core/styles';
import { fade } from '@material-ui/core/styles/colorManipulator';
import classnames from 'classnames';
import CloseIcon from '@material-ui/icons/Close';
import IconButton from '@material-ui/core/IconButton';
import Typography from '@material-ui/core/Typography';

const buttonStyles = {
    padding: '0.5rem 2rem',
    textTransform: 'none',
    fontSize: '14px',
    borderRadius: '6px',
    fontWeight: '600',
    boxShadow: 'none',
}

const useStyles = makeStyles(
    theme => ({
        root: {
            borderRadius: '6px',
            padding: '1rem 2rem'
        },
        title: {
            display: 'flex',
            justifyContent: 'space-between',
            borderBottom: `1px solid ${theme.palette.primary.light}`,
            '& > *': {
                display: 'flex',
                justifyContent: 'space-between',
                width: '100%',
                paddingLeft: '1rem',
                paddingRight: '0.5rem',
                alignItems: 'center'
            }
        },
        cancel: {
            ...buttonStyles
        },
        confirmPrimary: {
            ...buttonStyles,
            backgroundColor: theme.palette.secondary.main,
            color: theme.palette.primary.main,
        },
        confirmWarning: {
            ...buttonStyles,
            color: theme.palette.background.default,
            backgroundColor: theme.palette.error.main,
            '&:hover': {
                backgroundColor: fade(theme.palette.error.main, 0.8),
                // Reset on mouse devices
                '@media (hover: none)': {
                    backgroundColor: 'transparent',
                },
            },
        },
        iconPaddingStyle: {
            paddingRight: '0.5em',
        },
        actions: {
            padding: '1rem'
        }
    }),
    { name: 'RaConfirm' }
);

/**
 * Confirmation dialog
 *
 * @example
 * <Confirm
 *     isOpen={true}
 *     title="Delete Item"
 *     content="Are you sure you want to delete this item?"
 *     confirm="Yes"
 *     confirmColor="primary"
 *     ConfirmIcon=ActionCheck
 *     CancelIcon=AlertError
 *     cancel="Cancel"
 *     onConfirm={() => { // do something }}
 *     onClose={() => { // do something }}
 * />
 */
const Confirm = props => {
    const {
        isOpen,
        loading,
        title,
        content,
        confirm,
        cancel,
        confirmColor,
        onClose,
        onConfirm,
        noCancel
    } = props;
    const classes = useStyles(props);

    const handleConfirm = React.useCallback(
        e => {
            e.stopPropagation();
            onConfirm(e);
        },
        [onConfirm]
    );

    const handleClick = React.useCallback(e => {
        e.stopPropagation();
    }, []);

    return (
        <Dialog
            open={isOpen}
            onClose={onClose}
            onClick={handleClick}
            aria-labelledby="alert-dialog-title"
            className={classes.root}
        >
            <DialogTitle className={classes.title}>
                <Typography variant="subtitle1">
                    {title && title}
                </Typography>
                <IconButton
                    aria-label="close"
                    onClick={onClose}
                    sx={{
                        position: 'absolute',
                        right: 8,
                        top: 8,
                        color: (theme) => theme.palette.grey[500],
                    }}
                >
                    <CloseIcon />
                </IconButton>
            </DialogTitle>
            <DialogContent>
                {typeof content === 'string' ? (
                    <DialogContentText>
                        {content}
                    </DialogContentText>
                ) : (
                    content
                )}
            </DialogContent>
            <DialogActions className={classes.actions}>
                {!noCancel && (
                    <Button
                        disabled={loading}
                        onClick={onClose}
                        variant='outlined'
                        className={classes.cancel}
                        fullWidth
                    >
                        {cancel}
                    </Button>
                )}
                <Button
                    disabled={loading}
                    onClick={handleConfirm}
                    className={classnames('ra-confirm', {
                        [classes.confirmWarning]: confirmColor === 'warning',
                        [classes.confirmPrimary]: confirmColor === 'primary',
                    })}
                    autoFocus
                    variant='outlined'
                    fullWidth
                >
                    {confirm}
                </Button>
            </DialogActions>
        </Dialog>
    );
};

Confirm.propTypes = {
    cancel: PropTypes.string,
    classes: PropTypes.object,
    confirm: PropTypes.string,
    confirmColor: PropTypes.string,
    ConfirmIcon: PropTypes.elementType,
    CancelIcon: PropTypes.elementType,
    content: PropTypes.node.isRequired,
    isOpen: PropTypes.bool,
    loading: PropTypes.bool,
    onClose: PropTypes.func.isRequired,
    onConfirm: PropTypes.func.isRequired,
    title: PropTypes.string.isRequired,
    noCancel: PropTypes.bool
};

Confirm.defaultProps = {
    cancel: 'Cancelar',
    classes: {},
    confirm: 'Eliminar',
    confirmColor: 'primary',
    isOpen: false,
    noCancel: false
};

export default Confirm;
