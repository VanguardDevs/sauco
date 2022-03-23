import * as React from 'react';
import { makeStyles, Box, fade } from '@material-ui/core';
import Tag from './Tag'

const useStyles = makeStyles(theme => ({
    root: {
        display: 'flex',
        justifyContent: 'start',
        flexDirection: 'row'
    }
}))

export default ({ items }) => {
    const classes = useStyles();

    return (
        <Box display="flex" className={classes.root}>
            {items.map((item, i) => (
                <Tag key={i} name={item.name} />
            ))}
        </Box>
    );
}
