import { Route } from 'react-router-dom';
import UpdatePassword from './account/UpdatePassword'
import { RouteWithoutLayout } from 'ra-core';

export default [
    <Route 
        path="/security" 
        render={() => <UpdatePassword />} 
    />
];

