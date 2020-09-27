import React from 'react';
import SignIn from './auth';
import Home from './home';
import GeographicArea from './geographic-area';
import Taxpayers from './taxpayers';
import Settings from './settings';
import Properties from './properties';
import Licenses from './licenses';
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
        <PrivateRoute path='/taxpayers' component={Taxpayers} />
        <PrivateRoute path='/licenses' component={Licenses} />
        <PrivateRoute path='/properties' component={Properties} />
        <PrivateRoute path='/geographic-area' component={GeographicArea} />
        <PrivateRoute path='/settings' component={Settings} />
      </Switch>
    </Router>
  ); 
}

