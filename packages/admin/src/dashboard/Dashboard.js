import * as React from 'react';
import { subDays, format, parseISO } from 'date-fns';
import { useDataProvider } from 'react-admin';
import { useMediaQuery } from '@material-ui/core';
import Welcome from './Welcome';

// Components
import PaymentChart from './PaymentChart';
import PendingLiquidations from './PendingLiquidations';
import EmmitedLicenses from './EmmitedLicenses';
import RegisteredTaxpayers from './RegisteredTaxpayers';
import CurrentPetroPrice from './CurrentPetroPrice';

const Spacer = () => <span style={{ width: '1em' }} />;
const VerticalSpacer = () => <span style={{ height: '1em' }} />;

const styles = {
    flex: { display: 'flex' },
    flexColumn: { display: 'flex', flexDirection: 'column' },
    leftCol: { flex: 1, marginRight: '0.5em' },
    rightCol: { flex: 1, marginLeft: '0.5em' },
    singleCol: { marginTop: '1em', marginBottom: '1em' },
};

const Dashboard = () => {
    const dataProvider = useDataProvider();
    const [state, setState] = React.useState({});
    const isXSmall = useMediaQuery(theme =>
        theme.breakpoints.down('xs')
    );
    const isSmall = useMediaQuery(theme =>
        theme.breakpoints.down('md')
    );

    const fetchPayments = React.useCallback(async () => {
        const aMonthAgo = subDays(new Date(), 30);
        const { data: payments, total } = await dataProvider.getList(
            'payments',
            {
                filter: { gt_date: aMonthAgo.toISOString() },
                sort: { field: 'processed_at', order: 'DESC' },
                pagination: { page: 1, perPage: 1336 },
            }
        );
        const aggregations = payments
            .reduce(
                (stats, payment) => {
                    stats.revenue += payment.amount;
                    return stats;
                },
                {
                    revenue: 0,
                    payments: [],
                }
            );

        setState(state => ({
            ...state,
            payments,
            revenue: aggregations.revenue.toLocaleString(undefined, {
                style: 'currency',
                currency: 'VES',
                minimumFractionDigits: 0,
                maximumFractionDigits: 0,
            })
        }));
    }, [dataProvider]);

    const fetchLiquidations = React.useCallback(async () => {
        const { total } = await dataProvider.getList(
            'liquidations',
            {
                filter: { status_id: 1 },
                sort: { field: 'processed_at', order: 'DESC' },
                pagination: { page: 1, perPage: 50 },
            }
        );

        setState(state => ({ ...state, pendingLiquidations: total }));
    }, [useDataProvider]);

    const fetchLicenses = React.useCallback(async () => {
        const { total } = await dataProvider.getList(
            'licenses',
            {
                filter: { status_id: 1 },
                sort: { field: 'emmision_date', order: 'DESC' },
                pagination: { page: 1, perPage: 50 },
            }
        );

        setState(state => ({ ...state, emmittedLicenses: total }));
    }, [useDataProvider]);

    const fetchTaxpayers = React.useCallback(async () => {
        const { total } = await dataProvider.getList(
            'taxpayers',
            {
                filter: { status_id: 1 },
                sort: { field: 'emmision_date', order: 'DESC' },
                pagination: { page: 1, perPage: 50 },
            }
        );

        setState(state => ({ ...state, registeredTaxpayers: total }));
    }, [useDataProvider]);

    const fetchPetroPrice = React.useCallback(async () => {
        const { data: prices } = await dataProvider.getList(
            'petro-prices',
            {
                filter: { status_id: 1 },
                sort: { field: 'created_at', order: 'DESC' },
                pagination: { page: 1, perPage: 50 },
            }
        );

        const price = (prices.length) ? prices[0] : 0;

        setState(state => ({
            ...state,
            currentPetroPrice: {
                value: price.value.toLocaleString(undefined, {
                    style: 'currency',
                    currency: 'VES',
                    minimumFractionDigits: 0,
                    maximumFractionDigits: 2,
                }),
                created_at: format(parseISO(price.created_at), "dd-MM-yyyy h:m a").toUpperCase()
            }
        }));
    }, [useDataProvider]);

    React.useEffect(() => {
        fetchPayments();
        fetchLiquidations();
        fetchTaxpayers();
        fetchLicenses();
        fetchPetroPrice();
    }, []);

    const {
        pendingLiquidations,
        payments,
        emmittedLicenses,
        registeredTaxpayers,
        currentPetroPrice
    } = state;

    return isXSmall ? (
        <div>
            <div style={styles.flexColumn}>
                <Welcome />
                <VerticalSpacer />
                <PendingLiquidations value={pendingLiquidations} />
                <VerticalSpacer />
                <EmmitedLicenses value={emmittedLicenses} />
                <VerticalSpacer />
                <RegisteredTaxpayers value={registeredTaxpayers} />
                <VerticalSpacer />
                <CurrentPetroPrice {...currentPetroPrice} />
                <VerticalSpacer />
                <PaymentChart payments={payments} />
            </div>
        </div>
    ) : isSmall ?  (
        <div style={styles.flexColumn}>
            <div style={styles.singleCol}>
                <Welcome />
            </div>
            <div style={styles.flex}>
                <PendingLiquidations value={pendingLiquidations} />
                <Spacer />
                <CurrentPetroPrice {...currentPetroPrice} />
            </div>
            <VerticalSpacer />
            <div style={styles.flex}>
                <EmmitedLicenses value={emmittedLicenses} />
                <Spacer />
                <RegisteredTaxpayers value={registeredTaxpayers} />
            </div>
            <div style={styles.singleCol}>
                <PaymentChart payments={payments} />
            </div>
        </div>
    ) : (
        <>
            <Welcome />
            <div style={styles.flex}>
                <div style={styles.leftCol}>
                    <div style={styles.singleCol}>
                        <PaymentChart payments={payments} />
                    </div>
                </div>
                <div style={styles.rightCol}>
                    <div style={styles.flexColumn}>
                        <EmmitedLicenses value={emmittedLicenses} />
                        <VerticalSpacer />
                        <RegisteredTaxpayers value={registeredTaxpayers} />
                        <VerticalSpacer />
                        <PendingLiquidations value={pendingLiquidations} />
                        <VerticalSpacer />
                        <CurrentPetroPrice {...currentPetroPrice} />
                        <VerticalSpacer />
                    </div>
                </div>
            </div>
        </>
    );
};

export default Dashboard;
