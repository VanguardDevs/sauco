import * as React from 'react';
import PropTypes from 'prop-types';
import { makeStyles } from '@material-ui/core/styles';
import { fade } from '@material-ui/core/styles/colorManipulator';
import classnames from 'classnames';
import Box from '@material-ui/core/Box';
import Typography from '@material-ui/core/Typography';

const DeleteButton = (
    props
) => {
    const {
        classes: classesOverride,
        className,
        icon,
        label,
        onClick,
        ...rest
    } = props;
    const classes = useStyles(props);

    const handleClick = e => {
        onClick();
        e.stopPropagation();
    };

    return (
        <Box
            className={classnames(
                'ra-delete-button',
                classes.deleteButton,
                className
            )}
            key="button"
            onClick={handleClick}
            {...rest}
        >
            {icon && (
                React.cloneElement(icon, {
                    className: classes.icon
                })
            )}
            {(label) &&
                <Typography variant="subtitle2">
                    {label}
                </Typography>
            }
        </Box>
    );
};

const useStyles = makeStyles(
    theme => ({
        deleteButton: {
            color: theme.palette.primary.main,
            textTransform: 'none',
            '&:hover': {
                borderRadius: '4px',
                backgroundColor: fade(theme.palette.primary.light, 0.12),
                // Reset on mouse devices
                '@media (hover: none)': {
                    backgroundColor: 'transparent',
                },
            },
            width: 'inherit',
            display: 'flex',
            justifyContent: 'center'
        },
        icon: {
            marginRight: '0.4rem'
        }
    }),
    { name: 'RaDeleteWithConfirmButton' }
);

DeleteButton.propTypes = {
    label: PropTypes.string,
    icon: PropTypes.element
};

export default DeleteButton;
