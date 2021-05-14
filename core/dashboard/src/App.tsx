import React from 'react';
import { Admin, Resource } from 'react-admin';
import dataProvider from './dataProvider';
import { history } from './utils';
import { Dashboard } from './dashboard';
import { Layout } from './layouts';
import i18nProvider from './i18nProvider';
// Resources
import concepts from './concepts';
import movements from './movements';
import liquidations from './liquidations';
import payments from './payments';
import cancellations from './cancellations';
import customRoutes from './routes';
import affidavits from './affidavits';
import taxpayers from './taxpayers';
import fines from './fines';
import applications from './applications';
import licenses from './licenses';
import paymentTypes from './payment-types';
import paymentMethods from './payment-methods';
import users from './users';

function App() {
  return (
    <Admin
      layout={Layout}
      dashboard={Dashboard}
      history={history}
      customRoutes={customRoutes}
      dataProvider={dataProvider}
      i18nProvider={i18nProvider}
    >
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
      <Resource name="ordinances" />
      <Resource name="cancellation-types" />
      <Resource name="liquidation-types" />
      <Resource name="taxpayer-types" />
      <Resource name="taxpayer-classifications" />
      <Resource name="status" />
    </Admin>
  );
}

export default App;
