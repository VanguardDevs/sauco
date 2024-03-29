import * as React from 'react';
import { Card, Box, Typography, Divider } from '@material-ui/core';
import { makeStyles } from '@material-ui/core/styles';
import { Link } from 'react-router-dom';

import cartouche from './cartouche.png';
import cartoucheDark from './cartoucheDark.png';

interface Props {
    icon: React.FC<any>;
    to: string;
    title?: string;
    subtitle?: string | number;
    extra?: string;
}

const useStyles = makeStyles(theme => ({
    card: {
        minHeight: 52,
        display: 'flex',
        flexDirection: 'column',
        flex: '1',
        '& a': {
            textDecoration: 'none',
            color: 'inherit',
        },
    },
    main: (props: Props) => ({
        overflow: 'inherit',
        padding: 16,
        background: `url(${
            theme.palette.type === 'dark' ? cartoucheDark : cartouche
        }) no-repeat`,
        display: 'flex',
        justifyContent: 'space-between',
        alignItems: 'center',
        '& .icon': {
            color: theme.palette.type === 'dark' ? 'inherit' : '#dc2440',
        },
    }),
    title: {},
}));

const CardWithIcon: React.FC<Props> = props => {
    const { icon, title, subtitle, to, children, extra } = props;
    const classes = useStyles(props);

    return (
        <Card className={classes.card}>
            <Link to={to}>
                <div className={classes.main}>
                    <Box width="3em" className="icon">
                        {React.createElement(icon, { fontSize: 'large' })}
                    </Box>
                    <Box textAlign="right">
                        <Typography
                            className={classes.title}
                            color="textPrimary"
                        >
                            {title}
                        </Typography>
                        <Typography variant="h5" component="h2">
                            {subtitle || ' '}
                        </Typography>
                        {(extra) && (
                            <Typography variant="body2" component="small" color="textSecondary">
                                {extra}
                            </Typography>
                        )}
                    </Box>
                </div>
            </Link>
            {children && <Divider />}
            {children}
        </Card>
    );
};

export default CardWithIcon;
