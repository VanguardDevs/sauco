import { makeStyles } from '@material-ui/core'

const useStyles = makeStyles(theme => ({
    root: {
        height: '25vh',
        width: '100%'
    },
    loader: {
        height: '2rem !important',
        width: '2rem !important',
        color: theme.palette.info.main
    }
}))

export default useStyles
