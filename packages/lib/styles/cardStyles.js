import { makeStyles } from '@material-ui/core'

const cardStyles = makeStyles(theme => ({
    root: {
        margin: '0 1rem 1rem 0',
        borderRadius: '8px !important',
        background: '#F9F9F9',
        cursor: 'pointer !important',
        '&:hover': {
            boxShadow: "4px 4px 90px 0px #00000014"
        },
    },
    cardHeader: {
        padding: '1em 1em 0 1em !important'
    },
    cardContent: {
        padding: '1em',
    },
    innerContent: {
        display: 'flex',
        justifyContent: 'start',
        flexDirection: 'row',
        alignItems: 'center'
    },
    divider: {
        width: '4px',
        borderRadius: '50%',
        background: theme.palette.text.primary,
        height: '4px',
        margin: '0 0.5em',
        '&::after': {
            content: '',
            position: 'absolute',
            width: '4px',
            height: '100%',
            background: '#fff',
            right: 0,
            left: 0,
            textAlign: 'center',
            margin: '0 auto',
            '-webkit-transform': 'rotate(-66deg)',
            '-moz-transform': 'rotate(-66deg)',
            '-o-transform': 'rotate(-66deg)',
            '-ms-transform': 'rotate(-66deg)',
            'transform': 'rotate(-66deg)',
        }
    },
    link: {
        textDecoration: 'none',
        color: theme.palette.primary.main,
        '&:hover': {
            textDecoration: 'underline',
            cursor: 'pointer'
        },
        '&visited': {
            color: theme.palette.primary.main,
        }
    },
}))

export default cardStyles;
