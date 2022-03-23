import * as React from 'react';
import { makeStyles, fade } from '@material-ui/core/styles';
import classnames from 'classnames';
import { useResourceContext } from 'ra-core';
import Button from '@material-ui/core/Button';
import Fab from '@material-ui/core/Fab';
import useMediaQuery from '@material-ui/core/useMediaQuery';
import { ReactComponent as PlusIcon } from '@approbado/lib/icons/Plus.svg'

const CreateButton = props => {
    const {
        basePath = '',
        className,
        classes: classesOverride,
        label = 'Crear',
        scrollToTop = true,
        variant,
        ...rest
    } = props;
    const classes = useStyles(props);
    const isSmall = useMediaQuery(theme =>
        theme.breakpoints.down('sm')
    );
    const resource = useResourceContext();

    return isSmall ? (
        <Fab
            className={classnames(classes.floating, className)}
            aria-label={label}
            {...rest}
        >
            <PlusIcon />
        </Fab>
    ) : (
        <Button
            className={classnames(classes.fullwidth, className)}
            label={label}
            variant={variant}
            color="secondary"
            {...rest}
        >
            Descargar
        </Button>
    );
};

const useStyles = makeStyles(
    theme => ({
        floating: {
            margin: 0,
            top: 'auto',
            right: 20,
            bottom: 60,
            left: 'auto',
            position: 'fixed',
            zIndex: 1000,
            backgroundColor: theme.palette.secondary.main,
            color: theme.palette.primary.main,
        },
        fullwidth: {
            backgroundColor: theme.palette.secondary.main,
            color: theme.palette.primary.main,
            '&:hover': {
                backgroundColor: `${fade(theme.palette.secondary.main, 0.8)} !important`
            }
        }
    }),
    { name: 'RaCreateButton' }
);

export default CreateButton;
