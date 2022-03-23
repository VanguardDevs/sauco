import * as React from 'react';
import Card from '@material-ui/core/Card';
import CardContent from '@material-ui/core/CardContent';
import Grid from '@material-ui/core/Grid';
import Typography from '@material-ui/core/Typography';
import { makeStyles } from '@material-ui/core/styles';
import {
    useShowController
} from 'react-admin';
import { Taxpayer } from '@sauco/common/types';
import Box from '@material-ui/core/Box';
import AddLocationIcon from '@material-ui/icons/AddLocation';
import LocalPhoneIcon from '@material-ui/icons/LocalPhone';
import EmailIcon from '@material-ui/icons/Email';
import TextFieldIcon from '@sauco/common/components/TextFieldIcon'
import Avatar from '@sauco/common/components/Avatar';

const TaxpayerShow = (props: any) => {
    const { record } = useShowController<Taxpayer>(props);
    const classes = useStyles();

    if (!record) return null;

    return (
        <Box className={classes.root}>
            <Card className={classes.header}>
                <CardContent>
                    <Grid container spacing={2}>
                        <Grid item xs={1}>
                            <Avatar picture={record.picture} />
                        </Grid>
                        <Grid item xs={11}>
                            <Typography variant="h6" gutterBottom align="left">
                                {record.name}
                            </Typography>
                            <Typography variant="subtitle1" gutterBottom align="left">
                                {record.rif}
                            </Typography>
                        </Grid>
                    </Grid>
                    <Grid container spacing={2}>
                        <TextFieldIcon
                            text={record.fiscal_address}
                            icon={<AddLocationIcon />}
                        />
                        {(record.phone) && (
                            <TextFieldIcon
                                text={record.phone}
                                icon={<LocalPhoneIcon />}
                            />
                        )}
                        {(record.email) && (
                            <TextFieldIcon
                                text={record.email}
                                icon={<EmailIcon />}
                            />
                        )}
                    </Grid>
                </CardContent>
            </Card>
        </Box>
    );
};

export default TaxpayerShow;

const useStyles = makeStyles(theme => ({
    root: { width: '100%' },
    header: {
        width: '100%'
    },
    spacer: { height: 20 },
}));
