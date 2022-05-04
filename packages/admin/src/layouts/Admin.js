import { Sidebar } from 'react-admin';
import Menu from './Menu';
import MenuItems from './MenuItems';
import { makeStyles } from '@material-ui/core/styles';
import AppBar from './AppBar';

const CustomSidebar = props => <Sidebar {...props} size={200} />;

const CustomMenu = props => (
    <Menu {...props}>
        <MenuItems />
    </Menu>
)

const styles = makeStyles(theme => ({
    root: {
        display: 'flex',
        flexDirection: 'column',
        zIndex: 1,
        minHeight: '100vh',
        backgroundColor: theme.palette.background.default,
        position: 'relative',
        minWidth: 'fit-content',
        width: '100%',
        color: theme.palette.getContrastText(
            theme.palette.background.default
        ),
    },
    appFrame: {
        display: 'flex',
        flexDirection: 'column',
        flexGrow: 1,
        [theme.breakpoints.up('xs')]: {
            marginTop: theme.spacing(6),
        },
        [theme.breakpoints.down('xs')]: {
            marginTop: theme.spacing(7),
        },
    },
    contentWithSidebar: {
        display: 'flex',
        flexGrow: 1,
    },
    content: {
        display: 'flex',
        flexDirection: 'column',
        flexGrow: 1,
        flexBasis: 0,
        padding: '0 2rem !important',
        marginTop: '6em'
    },
}));

export default ({ children }) => {
    const classes = styles()

    return (
        <>
            <div className={classes.root}>
                <AppBar />
                <main className={classes.contentWithSidebar}>
                    <CustomSidebar>
                        <CustomMenu />
                    </CustomSidebar>
                    <div id="main-content" className={classes.content}>
                        {children}
                    </div>
                </main>
            </div>
        </>
    )
};
