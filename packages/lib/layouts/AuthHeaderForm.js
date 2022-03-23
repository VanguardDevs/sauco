import { Typography, makeStyles, Grid } from "@material-ui/core";

const useStyles = makeStyles(theme => ({
    root: {
        alignItems: 'center',
        flexDirection: 'column',
        padding: '1em 0'
    }
}));

export default ({ title }) => {
    const classes = useStyles();

    return (
        <Grid container className={classes.root}>
            <Typography variant='h5' component='h5'>
                {title}
            </Typography>
        </Grid>
    )
}
