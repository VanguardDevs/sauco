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
import permissions from './permissions';
import economicActivities from './economic-activities';
import petroPrices from './petro-prices';
import routes from './routes'
import liquidationTypes from './liquidation-types';
import parishes from './parishes';
import signatures from './signatures';
import { i18nProvider } from './i18nProvider';
import accoutingAccounts from './accounting-accounts';

const App = () => (
    <Admin
        title=""
        layout={Layout}
        dashboard={Dashboard}
        history={history}
        loginPage={Login}
        customRoutes={routes}
        authProvider={authProvider}
        i18nProvider={i18nProvider}
        dataProvider={dataProvider}
        locale="es"
        disableTelemetry
    >
        <Resource {...accoutingAccounts} />
        <Resource {...paymentTypes} />
        <Resource {...paymentMethods} />
        <Resource {...taxpayers} />
        <Resource {...payments} />
        <Resource {...cancellations} />
        <Resource {...liquidations} />
        <Resource {...concepts} />
        <Resource {...movements} />
        <Resource {...applications} />
        <Resource {...fines} />
        <Resource {...affidavits} />
        <Resource {...licenses} />
        <Resource {...users} />
        <Resource {...ordinances} />
        <Resource {...economicActivities} />
        <Resource {...petroPrices} />
        <Resource {...permissions} />
        <Resource {...states} />
        <Resource {...municipalities} />
        <Resource {...parishes} />
        <Resource {...signatures} />
        <Resource {...liquidationTypes} />
        <Resource name="cancellation-types" />
        <Resource name="taxpayer-types" />
        <Resource name="charging-methods" />
        <Resource name="taxpayer-classifications" />
        <Resource name="status" />
        <Resource name="communities" />
        <Resource name="roles" />
    </Admin>
)

export default App;
