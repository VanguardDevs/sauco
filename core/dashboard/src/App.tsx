import React from 'react';
import { Admin, Resource } from 'react-admin';
import apiClient from 'ra-laravel-client';
import { history } from './utils';
import { Dashboard } from './dashboard';
import users from './users';
import customRoutes from './routes';

function App() {
  console.log(process.env.REACT_APP_DOMAIN);
  return (
    <Admin
      dashboard={Dashboard}
      history={history}
      customRoutes={customRoutes}
      dataProvider={apiClient(`${process.env.REACT_APP_DOMAIN}`)}
    > 
      <Resource name='users' {...users} />
    </Admin>
  );
}

export default App;
