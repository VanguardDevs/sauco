import React from 'react';
import SignIn from './auth';
import Home from './home';
import GeographicArea from './geographic-area';
import { Router, Route, Switch } from 'react-router-dom';
import { PrivateRoute, history } from '../utils';

export default function App() {
  return (
    <Router history={history}>
      <Switch>
        <Route path='/signin' component={SignIn} />
      </Switch>
      <Switch>
        <PrivateRoute path='/home' component={Home} />
        <PrivateRoute path='/geographic-area' component={GeographicArea} />
      </Switch>
    </Router>
  ); 
}

