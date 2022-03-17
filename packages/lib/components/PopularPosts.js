import * as React from 'react';
import Typography from '@material-ui/core/Typography';
import PropTypes from 'prop-types'
import Box from '@material-ui/core/Box';
import { Query } from 'react-admin';
import Emoji from '@../components/Emoji'
import { makeStyles } from '@material-ui/core'
import { Link } from 'react-router-dom'
import Spinner from '@../components/Spinner'
import useSpinnerStyles from '@../styles/useSpinnerStyles'

const payload = {
    pagination: { page: 1, perPage: 5 },
    sort: { field: 'comments', order: 'DESC'}
};

const useStyles = makeStyles(theme => ({
    title: {
        fontWeight: '700',
        fontSize: '1.5rem',
        marginBottom: '2rem'
    },
    container: {
        padding: '1.6rem 0.4rem',
        color: theme.palette.info.light,
        borderTop: '1px solid rgba(0, 0, 0, 0.12)'
    },
    postTitle: {
        color: theme.palette.primary.main,
        fontWeight: 600,
        cursor: 'pointer',
        fontSize: '1rem',
        textDecoration: 'none',
        '&:hover': {
            textDecoration: 'underline'
        }
    },
    username: {
        marginLeft: '0.2rem',
        fontWeight: '600',
        cursor: 'pointer',
        color: theme.palette.primary.main,
        textDecoration: 'none',
        '&:hover': {
            textDecoration: 'underline'
        }
    },
    description: {
        paddingTop: '1rem',
        display: 'flex',
        fontSize: '0.9rem'
    }
}))

const AsideBar = ({ isXSmall }) => {
    const classes = useStyles();
    const spinnerClasses = useSpinnerStyles();

    return (
        <Box>
            {!isXSmall && (
                <Box p='0 0 0 2rem'>
                    <Typography component="div">
                        <Box className={classes.title}>
                            Debates más hots{' '} <Emoji symbol="😰" />
                        </Box>
                    </Typography>
                    <Query type='getList' resource='forums' payload={payload}>
                        {({ data, total, loading, error }) => {
                            if (loading) {
                                return (
                                    <Spinner classes={spinnerClasses} />
                                );
                            }
                            if (error) { return null; }

                            return (
                                <div>
                                    {data.map(post =>
                                        <Box className={classes.container}>
                                            <Box className={classes.innerContent}>
                                                <Link
                                                    className={classes.postTitle}
                                                    to={`/forums/${post.id}/show`}
                                                >
                                                    {post.message}
                                                </Link>
                                                <Box className={classes.description}>
                                                    Por
                                                    <Link
                                                        className={classes.username}
                                                        to={`/users/${post.owner.id}/show`}
                                                    >
                                                        {post.owner.names}
                                                    </Link>
                                                </Box>
                                            </Box>
                                        </Box>
                                    )}
                                    {(total == 0) && (
                                        <Box className={classes.description}>
                                            <Typography component={'p'} variant="body1">
                                                No tenemos debates disponibles
                                            </Typography>
                                        </Box>
                                    )}
                                </div>
                            );
                        }}
                    </Query>
                </Box>
            )}
        </Box>
    );
}

AsideBar.propTypes = {
    isXSmall: PropTypes.bool
}

export default AsideBar
