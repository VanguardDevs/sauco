import React from 'react';
import { Route, Redirect } from 'react-router-dom';
import CONFIG_NAMES from '../configs'

const PrivateRoute = ({ component: Component, ...rest }) => (
    <Route {...rest} render={props => (
        localStorage.getItem(CONFIG_NAMES.token)
        ? <Component {...props} />
        : <Redirect to={{ pathname: '/login', state: { from: props.location } }} />
    )} />
);

export default PrivateRoute;
