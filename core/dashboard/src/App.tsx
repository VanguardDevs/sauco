import React from 'react';
import { Admin, Resource } from 'react-admin';
import dataProvider from './dataProvider';
import { history } from './utils';
import { Dashboard } from './dashboard';
import concepts from './concepts';
import movements from './movements';
import liquidations from './liquidations';
import payments from './payments';
import cancellations from './cancellations';
import customRoutes from './routes';

function App() {
  return (
    <Admin
      dashboard={Dashboard}
      history={history}
      customRoutes={customRoutes}
      dataProvider={dataProvider}
    > 
      <Resource {...payments} />
      <Resource {...cancellations} />
      <Resource {...liquidations} />
      <Resource {...concepts} />
      <Resource {...movements} />
      <Resource name="cancellation-types" />
      <Resource name="liquidation-types" />
      <Resource name="payment-types" />
      <Resource name="payment-methods" />
    </Admin>
  );
}

export default App;
