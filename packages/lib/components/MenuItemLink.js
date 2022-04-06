import * as React from 'react';
import PropTypes from 'prop-types';
import classnames from 'classnames';
import { useDispatch } from 'react-redux';
import { NavLink } from 'react-router-dom';
import { setSidebarVisibility } from 'ra-core';
import MenuItem from '@material-ui/core/MenuItem';
import Tooltip from '@material-ui/core/Tooltip';
import ListItemIcon from '@material-ui/core/ListItemIcon';
import { useMediaQuery, makeStyles, fade } from '@material-ui/core';

const NavLinkRef = React.forwardRef((props, ref) => (
    <NavLink innerRef={ref} {...props} />
));

const useStyles = makeStyles(
    theme => ({
        root: {
            color: theme.palette.primary.light,
            fill: theme.palette.primary.light,
            stroke: theme.palette.primary.light,
            borderRadius: '6px',
            marginTop: '0.15rem',
            display: 'flex',
            alignItems: 'center',
            width: "100%",
            '&:hover': {
                backgroundColor: fade(theme.palette.primary.light, 0.16),
            }
        },
        active: {
            borderLeft: `3px solid ${theme.palette.secondary.main}`,
            backgroundColor: fade(theme.palette.secondary.main, 0.16),
            color: theme.palette.secondary.main,
            fill: theme.palette.secondary.main,
            stroke: theme.palette.secondary.main,
            width: "100%"
        },
        linkIcon: {
            minWidth: theme.spacing(4),
            color: 'inherit'
        },
        icon: {
            fill: 'inherit',
            stroke: 'inherit',
        },
    }),
    { name: 'RaMenuItemLink' }
);

const MenuItemLink = React.forwardRef((props, ref) => {
    const {
        classes: classesOverride,
        className,
        primaryText,
        leftIcon,
        onClick,
        isOpen,
        sidebarIsOpen,
        tooltipProps,
        ...rest
    } = props;

    const classes = useStyles(props);
    const dispatch = useDispatch();
    const isSmall = useMediaQuery(theme => theme.breakpoints.down('sm'));
    const handleMenuTap = React.useCallback(
        e => {
            if (isSmall) {
                dispatch(setSidebarVisibility(false));
            }
            onClick && onClick(e);
        },
        [dispatch, isSmall, onClick]
    );

    const renderMenuItem = () => {
        return (
            <MenuItem
                className={classnames(classes.root, className)}
                activeClassName={classes.active}
                component={NavLinkRef}
                ref={ref}
                tabIndex={0}
                {...rest}
                onClick={handleMenuTap}
            >
                {leftIcon && (
                    <ListItemIcon className={classes.linkIcon}>
                        {React.cloneElement(leftIcon, {
                            titleAccess: primaryText,
                            className: classes.icon
                        })}
                    </ListItemIcon>
                )}
                {sidebarIsOpen && primaryText}
            </MenuItem>
        );
    };

    return sidebarIsOpen ? (
        renderMenuItem()
    ) : (
        <Tooltip title={primaryText} placement="right" {...tooltipProps}>
            {renderMenuItem()}
        </Tooltip>
    );
});

MenuItemLink.propTypes = {
    classes: PropTypes.object,
    className: PropTypes.string,
    leftIcon: PropTypes.element,
    onClick: PropTypes.func,
    primaryText: PropTypes.node,
    staticContext: PropTypes.object,
    to: PropTypes.oneOfType([PropTypes.string, PropTypes.object]).isRequired,
    sidebarIsOpen: PropTypes.bool,
};

export default MenuItemLink;
