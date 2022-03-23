import * as React from 'react';
import { makeStyles, fade } from '@material-ui/core/styles';
import classnames from 'classnames';
import { Link } from 'react-router-dom';
import { useResourceContext } from 'ra-core';
import Button from '@material-ui/core/Button';
import Fab from '@material-ui/core/Fab';
import useMediaQuery from '@material-ui/core/useMediaQuery';
import PlusIcon from '@material-ui/icons/Add';

/**
 * Opens the Create view of a given resource
 *
 * Renders as a regular button on desktop, and a Floating Action Button
 * on mobile.
 *
 * @example // basic usage
 * import { CreateButton } from 'react-admin';
 *
 * const CommentCreateButton = () => (
 *     <CreateButton basePath="/comments" label="Create comment" />
 * );
 */
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
    const location = React.useMemo(
        () => ({
            pathname: basePath ? `${basePath}/create` : `/${resource}/create`,
            state: { _scrollToTop: scrollToTop },
        }),
        [basePath, resource, scrollToTop]
    );

    return isSmall ? (
        <Fab
            component={Link}
            className={classnames(classes.floating, className)}
            to={location}
            aria-label={label}
            {...rest}
        >
            <PlusIcon />
        </Fab>
    ) : (
        <Button
            component={Link}
            to={location}
            className={classnames(classes.fullwidth, className)}
            label={label}
            variant={variant}
            color="secondary"
            {...rest}
        >
            {label}
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
