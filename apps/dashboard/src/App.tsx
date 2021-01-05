import React from 'react';
import { Admin, Resource } from 'react-admin';
import apiClient from 'ra-laravel-client';
import { history } from './utils';
import { Dashboard } from './dashboard';
import users from './users';
import customRoutes from './routes';

function App() {
  return (
    <Admin
      dashboard={Dashboard}
      history={history}
      customRoutes={customRoutes}
      dataProvider={apiClient('http://dev.sauco.loc/api')}
    > 
      <Resource name='users' {...users} />
    </Admin>
  );
}

export default App;
