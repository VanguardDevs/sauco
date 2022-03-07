import * as React from 'react';
import { Payment, Liquidation, License, PetroPrice } from '@sauco/common/types';
import { subDays } from 'date-fns';
import { useDataProvider } from 'react-admin';
import { useMediaQuery, Theme } from '@material-ui/core';
import Welcome from './Welcome';
import MonthlyRevenue from './MonthlyRevenue';

// Components
import PaymentChart from './PaymentChart';
import PendingLiquidations from './PendingLiquidations';
import EmmitedLicenses from './EmmitedLicenses';
import RegisteredTaxpayers from './RegisteredTaxpayers';
import CurrentPetroPrice from './CurrentPetroPrice';

interface State {
    payments?: Payment[];
    revenue?: string;
    pendingLiquidations?: number;
    emmittedLicenses?: number;
    registeredTaxpayers?: number;
    currentPetroPrice?: string;
}

interface PaymentStats {
    revenue: number;
    payments: Payment[];
}

const Spacer = () => <span style={{ width: '1em' }} />;
const VerticalSpacer = () => <span style={{ height: '1em' }} />;

const styles = {
    flex: { display: 'flex' },
    flexColumn: { display: 'flex', flexDirection: 'column' },
    leftCol: { flex: 1, marginRight: '0.5em' },
    rightCol: { flex: 1, marginLeft: '0.5em' },
    singleCol: { marginTop: '1em', marginBottom: '1em' },
};

const Dashboard: React.FC = () => {
    const dataProvider = useDataProvider();
    const [state, setState] = React.useState<State>({});
    const isXSmall = useMediaQuery((theme: Theme) =>
        theme.breakpoints.down('xs')
    );
    const isSmall = useMediaQuery((theme: Theme) =>
        theme.breakpoints.down('md')
    );

    const fetchPayments = React.useCallback(async () => {
        const aMonthAgo = subDays(new Date(), 30);
        const { data: payments, total } = await dataProvider.getList<Payment>(
            'payments',
            {
                filter: { gt_date: aMonthAgo.toISOString() },
                sort: { field: 'processed_at', order: 'DESC' },
                pagination: { page: 1, perPage: 1336 },
            }
        );
        const aggregations = payments
            .reduce(
                (stats: PaymentStats, payment) => {
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
        const { total } = await dataProvider.getList<Liquidation>(
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
        const { total } = await dataProvider.getList<License>(
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
        const { total } = await dataProvider.getList<License>(
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
        const { data: prices } = await dataProvider.getList<License>(
            'petro-prices',
            {
                filter: { status_id: 1 },
                sort: { field: 'created_at', order: 'DESC' },
                pagination: { page: 1, perPage: 50 },
            }
        );

        const price: number = (prices.length) ? +prices[0].value : 0;

        setState(state => ({
            ...state,
            currentPetroPrice: price.toLocaleString(undefined, {
                style: 'currency',
                currency: 'VES',
                minimumFractionDigits: 0,
                maximumFractionDigits: 2,
            })
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
        registeredTaxpayers,
        currentPetroPrice
    } = state;

    return isXSmall ? (
        <div>
            <div style={styles.flexColumn as React.CSSProperties}>
                <Welcome />
                <VerticalSpacer />
                <RegisteredTaxpayers value={registeredTaxpayers} />
                <VerticalSpacer />
                <CurrentPetroPrice value={currentPetroPrice} />
            </div>
        </div>
    ) : isSmall ?  (
        <div style={styles.flexColumn as React.CSSProperties}>
            <div style={styles.singleCol}>
                <Welcome />
            </div>
            <div style={styles.flex}>
                <CurrentPetroPrice value={currentPetroPrice} />
            </div>
            <VerticalSpacer />
            <div style={styles.flex}>
                <RegisteredTaxpayers value={registeredTaxpayers} />
            </div>
        </div>
    ) : (
        <>
            <Welcome />
            <div style={styles.flex}>
                <div style={styles.rightCol}>
                    <div style={styles.flexColumn as React.CSSProperties}>
                        <RegisteredTaxpayers value={registeredTaxpayers} />
                        <VerticalSpacer />
                        <CurrentPetroPrice value={currentPetroPrice} />
                        <VerticalSpacer />
                    </div>
                </div>
            </div>
        </>
    );
};

export default Dashboard;
