import * as React from 'react';
import { makeStyles, Box } from '@material-ui/core';

const useStyles = makeStyles(theme => ({
    item: {
        color: theme.palette.secondary.light,
        display: 'flex',
        flexDirection: 'row',
        alignItems: 'center',
        padding: '4px 8px',
        backgroundColor: theme.palette.info.main,
        borderRadius: '6px',
        marginRight: '0.5rem',
        fontSize: '14px',
        fontWeight: '600',
        width: 'max-content',
        height: 'max-content'
    },
    icon: {
        marginRight: '0.3rem'
    }
}))

const Tag = ({ name, icon }) => {
    const classes = useStyles();

    return (
        <Box className={classes.item}>
            {(icon) && React.cloneElement(icon, {
                className: classes.icon
            })}
            {name}
        </Box>
    );
}

export default Tag;
