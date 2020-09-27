import * as React from 'react';
import Helmet from 'react-helmet';
import { Router, Route, Switch } from 'react-router-dom';
import { history } from '../utils';

export const App = () => (
  <>
    <Router history={history}>
    </Router>
  </>
)

