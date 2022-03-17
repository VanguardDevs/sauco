import * as React from 'react'
import Typography from '@material-ui/core/Typography'
import Box from '@material-ui/core/Box'
import { makeStyles } from '@material-ui/core'
import PropTypes from 'prop-types'

const useStyles = makeStyles(theme => ({
    root: {
        width: '100%',
        display: 'flex',
        flexDirection: 'column',
        alignItems: 'center',
        justifyContent: 'center',
        minHeight: 'inherit'
    },
    title: {
        fontWeight: 600,
        color: theme.palette.info.light
    }
}));

const NoContent = ({ icon, title }) => {
    const classes = useStyles();

    return (
        <Box className={classes.root}>
            {React.cloneElement(icon, {
                className: classes.icon
            })}
            <Typography className={classes.title}>
                {title}
            </Typography>
        </Box>
    );
}

NoContent.propTypes = {
    title: PropTypes.string,
    icon: React.ReactElement
}

export default NoContent;
