import { AppBar, UserMenu } from 'react-admin';
import Typography from '@material-ui/core/Typography';
import { useMediaQuery, Theme, makeStyles } from '@material-ui/core';

import Logo from './Logo';

const useStyles = makeStyles({
    title: {
        flex: 1,
        textOverflow: 'ellipsis',
        whiteSpace: 'nowrap',
        overflow: 'hidden',
    },
    spacer: {
        flex: 1,
    },
});

const CustomAppBar = (props: any) => {
    const classes = useStyles();
    const isXSmall = useMediaQuery((theme: Theme) =>
        theme.breakpoints.down('xs')
    );

    return (
        <AppBar {...props} elevation={1} userMenu={<UserMenu {...props} />}>
            <Typography
                variant="h6"
                color="inherit"
                className={classes.title}
                id="react-admin-title"
            />
            {!isXSmall && <Logo />}
            <span className={classes.spacer} />
        </AppBar>
    );
};

export default CustomAppBar;
