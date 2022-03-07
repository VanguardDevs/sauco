import { Admin, Resource } from 'react-admin';
import { authProvider, dataProvider } from '@sauco/common/providers';
import { history } from '@sauco/common/utils';
import { Dashboard } from './dashboard';
import { Layout, Login } from './layouts';
// Resources
// import users from './users';
import items from './items';
import { i18nProvider } from './i18nProvider';

const App = () => (
    <Admin
        layout={Layout}
        dashboard={Dashboard}
        history={history}
        loginPage={Login}
        authProvider={authProvider}
        i18nProvider={i18nProvider}
        dataProvider={dataProvider}
        locale="es"
        disableTelemetry
    >
        <Resource {...items} />
    </Admin>
)

export default App;
