import * as React from 'react';
import { useRedirect } from 'react-admin'
import { makeStyles } from '@material-ui/core'
import Card from '@material-ui/core/Card';
import CardHeader from '@material-ui/core/CardHeader';
import CardContent from '@material-ui/core/CardContent';
import Typography from '@material-ui/core/Typography';
import BalanceIcon from '@approbado/lib/icons/BalanceIcon'
import DeleteButton from '@approbado/lib/components/DeleteButton'
import OptionsCardMenu from '@approbado/lib/components/OptionsCardMenu';
import { ReactComponent as More } from '@approbado/lib/icons/More.svg'

const useStyles = makeStyles(theme => ({
    root: {
        borderRadius: '8px !important',
        background: theme.palette.background.dark,
        height: '8rem'
    },
    cardHeader: {
        padding: '1em !important'
    },
    cardContent: {
        padding: '1em',
        display: 'flex',
        justifyContent: 'space-between',
        width: '4rem',
        alignItems: 'center'
    },
    icon: {
        marginRight: '0.5rem'
    }
}))

const OptionsMenu = props => {
    const redirect = useRedirect();

    return (
        <OptionsCardMenu icon={<More />}>
            <DeleteButton
                basePath='trivias'
                confirmColor='warning'
                confirmTitle='Eliminar trivia'
                confirmContent={'¿Está seguro que desea eliminar esta trivia?'}
                label={'Eliminar'}
                customAction={() => redirect('/trivias')}
                {...props}
            />
        </OptionsCardMenu>
    )
};

const TriviaShowHeader = ({ record, icon, name, menu }) => {
    const classes = useStyles();

    return (
        <Card className={classes.root}>
            <CardHeader
                action={menu}
                title={record.name}
                className={classes.cardHeader}
            />
            <CardContent className={classes.cardContent}>
                {React.cloneElement(icon, {
                    className: classes.icon
                })}
                <Typography variant='subtitle1'>{name}</Typography>
            </CardContent>
        </Card>
    );
}

export default TriviaShowHeader;
