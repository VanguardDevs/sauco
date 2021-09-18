import { Admin, Resource } from 'react-admin';
import { authProvider, dataProvider } from '@sauco/common/providers';
import { history } from '@sauco/common/utils';
import { Dashboard } from './dashboard';
import { Layout, Login } from './layouts';
// Resources
import states from './states';
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
import municipalities from './municipalities';
import items from './items';
import permissions from './permissions';
import economicActivities from './economic-activities';
import petroPrices from './petro-prices';
import routes from './routes'
import liquidationTypes from './liquidation-types';
import parishes from './parishes';

const App = () => (
    <Admin
        title=""
        layout={Layout}
        dashboard={Dashboard}
        history={history}
        loginPage={Login}
        customRoutes={routes}
        authProvider={authProvider}
        dataProvider={dataProvider}
        disableTelemetry
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
            <Resource {...items} />,
            <Resource {...permissions} />,
            <Resource {...states} />,
            <Resource {...municipalities} />,
            <Resource {...parishes} />,
            <Resource {...liquidationTypes} />,
            <Resource name="cancellation-types" />,
            <Resource name="taxpayer-types" />,
            <Resource name="taxpayer-classifications" />,
            <Resource name="status" />,
        ]}
    </Admin>
)

export default App;
