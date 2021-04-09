import React from 'react';
import { Admin, Resource } from 'react-admin';
import apiClient from 'ra-laravel-client';
import { history } from './utils';
import { Dashboard } from './dashboard';
import users from './users';
import concepts from './concepts';
import movements from './movements';
import liquidations from './liquidations';
import customRoutes from './routes';

function App() {
  return (
    <Admin
      dashboard={Dashboard}
      history={history}
      customRoutes={customRoutes}
      dataProvider={apiClient(`${process.env.REACT_APP_DOMAIN}`)}
    > 
      <Resource name='users' {...users} />
      <Resource {...liquidations} />
      <Resource {...concepts} />
      <Resource {...movements} />
    </Admin>
  );
}

export default App;
