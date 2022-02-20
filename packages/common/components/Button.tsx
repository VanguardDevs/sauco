import * as React from 'react'
import { default as MuiButton } from '@material-ui/core/Button';
import CircularProgress from '@material-ui/core/CircularProgress';
import { makeStyles } from '@material-ui/core';
import { fade } from '@material-ui/core/styles/colorManipulator';
import Box from '@material-ui/core/Box';
import { useMediaQuery, Theme } from '@material-ui/core';
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
        padding: '0.7rem 1rem',
        textTransform: 'none',
        fontSize: '1rem',
        borderRadius: '8px !important',
        boxShadow: 'none',
        display: 'flex',
        justifyContent: 'space-between',
        maxWidth: '12rem',
        '&:hover': {
            boxShadow: `0px 2px 2px -2px ${theme.palette.primary.main}`,
            backgroundColor: fade(theme.palette.secondary.main, 0.95)
        }
    }
}));

const CustomButton: React.FC<CustomButtonProps> = ({
    disabled,
    children,
    unresponsive,
    icon,
    ...rest
}) => {
    const classes = useStyles();
    const isXSmall = useMediaQuery<Theme>(theme => theme.breakpoints.down('xs'));

    if (isXSmall && !unresponsive) {
        return (
            <Fab
                className={classes.floating}
                disabled={disabled}
                {...rest}
            >
                {icon}
            </Fab>
        )
    }

    const FullWidthButton = () => (
        <MuiButton
            className={classes.button}
            disabled={disabled}
            {...rest}
        >
            {(!disabled)
                ? <Box display="flex" justifyContent="space-between" width="100%">
                    {icon}
                    {children}
                </Box>
                : <CircularProgress className={classes.loader} size={'1rem'} />
            }
        </MuiButton>
    )

    return <FullWidthButton />
}

type SupportedVariants = "contained" | "outlined";

type SupportedButtonColors = "secondary" | "primary" | "info" | "danger";

interface CustomButtonProps {
    disabled: boolean;
    unresponsive: boolean;
    fullWidth: boolean;
    type: string;
    variant: SupportedVariants;
    color: SupportedButtonColors;
    icon: React.ReactNode
}

CustomButton.defaultProps = {
    fullWidth: true,
    disabled: false,
    unresponsive: false,
    variant: 'contained',
    color: 'primary',
    type: 'submit',
    icon: <PlusIcon />
}

export default CustomButton
