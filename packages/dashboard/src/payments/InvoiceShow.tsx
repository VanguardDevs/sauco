import * as React from 'react';
import Card from '@material-ui/core/Card';
import CardContent from '@material-ui/core/CardContent';
import Grid from '@material-ui/core/Grid';
import Typography from '@material-ui/core/Typography';
import { makeStyles } from '@material-ui/core/styles';
import {
    useShowController,
    ReferenceField,
    TextField,
} from 'react-admin';

// import Basket from '../orders/Basket';
// import { Customer, Invoice } from '../types';

// const CustomerField = ({ record }: FieldProps<Customer>) =>
//     record ? (
//         <Typography>
//             {record.first_name} {record.last_name}
//             <br />
//             {record.address}
//             <br />
//             {record.city}, {record.zipcode}
//         </Typography>
//     ) : null;

const CustomerField = ({ record }: any) =>
    record ? (
        <Typography>
            {record.name}
            <br />
            {record.address}
        </Typography>
    ) : null;

const InvoiceShow = (props: any) => {
    const { record } = useShowController(props);
    const classes = useStyles();

    if (!record) return null;

    return (
        <Card className={classes.root}>
            <CardContent>
                <Grid container spacing={2}>
                    <Grid item xs={6}>
                        <Typography variant="h6" gutterBottom>
                            Sauco
                        </Typography>
                    </Grid>
                    <Grid item xs={6}>
                        <Typography variant="h6" gutterBottom align="right">
                            Factura #{record.num}
                        </Typography>
                    </Grid>
                </Grid>
                <Grid container spacing={2}>
                    <Grid item xs={12} container alignContent="flex-end">
                        <ReferenceField
                            resource="payments"
                            reference="taxpayers"
                            source="taxpayer_id"
                            basePath="/payments"
                            record={record}
                            link={false}
                        >
                            <CustomerField />
                        </ReferenceField>
                    </Grid>
                </Grid>
                <div className={classes.spacer}>&nbsp;</div>
                <Grid container spacing={2}>
                    <Grid item xs={4}>
                        <Typography variant="h6" gutterBottom align="center">
                            Fecha{' '}
                        </Typography>
                        <Typography gutterBottom align="center">
                            {record.processed_at}
                        </Typography>
                    </Grid>

                    <Grid item xs={4}>
                        <Typography variant="h6" gutterBottom align="center">
                            Liquidador (login)
                        </Typography>
                        <ReferenceField
                            resource="payments"
                            reference="users"
                            source="user_id"
                            basePath="/payments"
                            record={record}
                            link={false}
                        >
                            <TextField
                                source="login"
                                align="center"
                                component="p"
                                gutterBottom
                            />
                        </ReferenceField>
                    </Grid>
                    <Grid item xs={4}>
                        <Typography variant="h6" gutterBottom align="center">
                            Tipo de pago
                        </Typography>
                        <ReferenceField
                            resource="payments"
                            reference="payment-types"
                            source="payment_type_id"
                            basePath="/payments"
                            record={record}
                            link={false}
                        >
                            <TextField
                                source="description"
                                align="center"
                                component="p"
                                gutterBottom
                            />
                        </ReferenceField>
                    </Grid>
                </Grid>
            </CardContent>
        </Card>
    );
};

export default InvoiceShow;

const useStyles = makeStyles({
    root: { width: 600, margin: 'auto' },
    spacer: { height: 20 },
    invoices: { margin: '10px 0' },
});
