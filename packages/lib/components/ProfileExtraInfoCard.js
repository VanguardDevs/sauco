import * as React from 'react'
import { makeStyles, fade } from '@material-ui/core'
import Typography from '@material-ui/core/Typography'
import Box from '@material-ui/core/Box'

const useStyles = makeStyles(theme => ({
    root: {
        width: '100%',
        display: 'flex',
        padding: '1.2rem 1rem'
    },
    content: {
        textAlign: 'left',
        marginLeft: '2rem'
    },
    imageContainer: {
        height: '3rem',
        width: '3rem',
        backgroundColor: fade(theme.palette.primary.light, 0.2),
        padding: '0.5rem',
        borderRadius: '50%'
    },
    image: {
        height: 'inherit',
        width: 'inherit',
    },
    amount: {
        fontWeight: 600
    },
    text: {
        fontWeight: 600,
        color: theme.palette.info.light
    }
}));

const ProfileExtraInfoCard = ({ Image, amount, text }) => {
    const classes = useStyles();

    return (
        <Box className={classes.root}>
            <Box className={classes.imageContainer}>
                {React.cloneElement(Image, {
                    className: classes.image
                })}
            </Box>
            <Box className={classes.content}>
                <Typography variant='h6' className={classes.amount}>
                    {amount}
                </Typography>
                <Typography variant='body2' className={classes.text}>
                    {text}
                </Typography>
            </Box>
        </Box>
    );
}

ProfileExtraInfoCard.propTypes = {
    Image: React.ReactElement
}

export default ProfileExtraInfoCard;
