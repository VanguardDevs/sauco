import * as React from 'react';
import { Route } from 'react-router-dom';
import Configurations from './configurations';

const routes = [
  <Route exact path="/configurations" render={() => <Configurations />} />,
];

export default routes;