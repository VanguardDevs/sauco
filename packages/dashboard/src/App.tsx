import { Admin, Resource } from 'react-admin';
import { authProvider, dataProvider } from '@sauco/common/providers';
import { history } from '@sauco/common/utils';
import { Dashboard } from './dashboard';
import { Layout, Login } from './layouts';
// Resources
import concepts from './concepts';
import movements from './movements';
import liquidations from './liquidations';
import payments from './payments';
import cancellations from './cancellations';
import affidavits from './affidavits';
import taxpayers from './taxpayers';
import fines from './fines';
import applications from './applications';
import licenses from './licenses';
import paymentTypes from './payment-types';
import paymentMethods from './payment-methods';
import users from './users';
import ordinances from './ordinances';
import economicActivities from './economic-activities';
import petroPrices from './petro-prices';

const App = () => (
    <Admin
        layout={Layout}
        dashboard={Dashboard}
        history={history}
        loginPage={Login}
        authProvider={authProvider}
        dataProvider={dataProvider}
    >
        {() => [
            <Resource {...paymentTypes} />,
            <Resource {...paymentMethods} />,
            <Resource {...taxpayers} />,
            <Resource {...payments} />,
            <Resource {...cancellations} />,
            <Resource {...liquidations} />,
            <Resource {...concepts} />,
            <Resource {...movements} />,
            <Resource {...applications} />,
            <Resource {...fines} />,
            <Resource {...affidavits} />,
            <Resource {...licenses} />,
            <Resource {...users} />,
            <Resource {...ordinances} />,
            <Resource {...economicActivities} />,
            <Resource {...petroPrices} />,
            <Resource name="cancellation-types" />,
            <Resource name="liquidation-types" />,
            <Resource name="taxpayer-types" />,
            <Resource name="taxpayer-classifications" />,
            <Resource name="status" />,
        ]}
    </Admin>
)

export default App;
