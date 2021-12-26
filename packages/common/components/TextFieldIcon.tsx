import * as React from 'react';
import Grid from '@material-ui/core/Grid';
import Typography from '@material-ui/core/Typography';
import { makeStyles } from '@material-ui/core/styles';
import Brightness1Icon from '@material-ui/icons/Brightness1';

const TextFieldIcon = ({ text, icon } : Props) => {
    const classes = useStyles();

    if (!text) return null;

    return (
        <Grid item className={classes.recordInfo}>
            {React.cloneElement(icon)}
            <Typography variant="body2" gutterBottom align="left">
                {text}
            </Typography>
        </Grid>
    );
};

export default TextFieldIcon;

const useStyles = makeStyles(theme => ({
    recordInfo: {
        display: 'flex',
        alignItems: 'center',
        transition: '300ms',
        cursor: 'pointer',
        '&:hover': {
            color: theme.palette.primary.main,
        },
        '& > *:nth-child(2)': {
            marginLeft: '0.5rem'
        }
    }
}));

TextFieldIcon.defaultProps = {
    icon: <Brightness1Icon />
}

interface Props {
    icon?: React.ReactElement,
    text: string | number
}
