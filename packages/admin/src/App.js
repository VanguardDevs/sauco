import React from 'react';
import { Switch, Route } from 'react-router-dom'
import ProtectedRoute from '@sauco/lib/components/ProtectedRoute';
import Layout from './layouts/Admin'
import Login from './auth/Login'
import Dashboard from './dashboard'

// Colors
import ColorList from './colors/ColorList'
import ColorCreate from './colors/ColorCreate'
import ColorEdit from './colors/ColorEdit'

// Brands
import BrandList from './brands/BrandList'
import BrandCreate from './brands/BrandCreate'
import BrandEdit from './brands/BrandEdit'

// Models
import ModelList from './models/ModelList'
import ModelCreate from './models/ModelCreate'
import ModelEdit from './models/ModelEdit'

// Vehicle Parameters
import VehicleParameterList from './parameters/VehicleParameterList'
import VehicleParameterCreate from './parameters/VehicleParameterCreate'
import VehicleParameterEdit from './parameters/VehicleParameterEdit'

const App = () => (
    <>
        <Route exact path='/login' render={() => <Login />} />

        <Switch>
            <ProtectedRoute layout={Layout} exact path="/" component={() => <Dashboard />} />
            <ProtectedRoute layout={Layout} exact path="/colors" component={() => <ColorList />} />
            <ProtectedRoute layout={Layout} exact path="/colors/create" component={() => <ColorCreate />} />
            <ProtectedRoute layout={Layout} exact path="/colors/:id" component={(routeProps) =>
                <ColorEdit
                    resource="colors"
                    basePath={routeProps.match.url}
                    id={decodeURIComponent((routeProps.match).params.id)}
                    {...routeProps}
                />
            } />
        </Switch>
        <Switch>
            <ProtectedRoute layout={Layout} exact path="/brands" component={() => <BrandList />} />
            <ProtectedRoute layout={Layout} exact path="/brands/create" component={() => <BrandCreate />} />
            <ProtectedRoute layout={Layout} exact path="/brands/:id" component={(routeProps) =>
                <BrandEdit
                    resource="brands"
                    basePath={routeProps.match.url}
                    id={decodeURIComponent((routeProps.match).params.id)}
                    {...routeProps}
                />
            } />
        </Switch>
        <Switch>
            <ProtectedRoute layout={Layout} exact path="/models" component={() => <ModelList />} />
            <ProtectedRoute layout={Layout} exact path="/models/create" component={() => <ModelCreate />} />
            <ProtectedRoute layout={Layout} exact path="/models/:id" component={(routeProps) =>
                <ModelEdit
                    resource="models"
                    basePath={routeProps.match.url}
                    id={decodeURIComponent((routeProps.match).params.id)}
                    {...routeProps}
                />
            } />
        </Switch>
        <Switch>
            <ProtectedRoute layout={Layout} exact path="/vehicle-parameters" component={() => <VehicleParameterList />} />
            <ProtectedRoute layout={Layout} exact path="/vehicle-parameters/create" component={() => <VehicleParameterCreate />} />
            <ProtectedRoute layout={Layout} exact path="/vehicle-parameters/:id" component={(routeProps) =>
                <VehicleParameterEdit
                    resource="vehicle-parameters"
                    basePath={routeProps.match.url}
                    id={decodeURIComponent((routeProps.match).params.id)}
                    {...routeProps}
                />
            } />
        </Switch>
    </>
)

export default App;
