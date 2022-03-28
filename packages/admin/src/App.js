import React from 'react';
import { Switch, Route } from 'react-router-dom'
import ProtectedRoute from '@sauco/lib/components/ProtectedRoute';
import Layout from './layouts/Admin'
import Login from './auth/Login'
import Dashboard from './dashboard'

// Colors
import ColorList from './settings/colors/ColorList'
import ColorCreate from './settings/colors/ColorCreate'
import ColorEdit from './settings/colors/ColorEdit'

// Brands
import BrandList from './settings/brands/BrandList'
import BrandCreate from './settings/brands/BrandCreate'
import BrandEdit from './settings/brands/BrandEdit'

// Models
import ModelList from './settings/models/ModelList'
import ModelCreate from './settings/models/ModelCreate'
import ModelEdit from './settings/models/ModelEdit'

// Vehicle Classifications
import VehicleClassificationList from './settings/vehicle-classifications/VehicleClassificationList'
import VehicleClassificationCreate from './settings/vehicle-classifications/VehicleClassificationCreate'
import VehicleClassificationEdit from './settings/vehicle-classifications/VehicleClassificationEdit'


// Vehicle Parameters
import VehicleParameterList from './settings/vehicle-parameters/VehicleParameterList'
import VehicleParameterCreate from './settings/vehicle-parameters/VehicleParameterCreate'
import VehicleParameterEdit from './settings/vehicle-parameters/VehicleParameterEdit'

// Zones
import ZoneList from './settings/zones/ZoneList'
import ZoneCreate from './settings/zones/ZoneCreate'
import ZoneEdit from './settings/zones/ZoneEdit'

// Annexes
import AnnexList from './settings/annexes/AnnexList'
import AnnexCreate from './settings/annexes/AnnexCreate'
import AnnexEdit from './settings/annexes/AnnexEdit'


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
            <ProtectedRoute layout={Layout} exact path="/vehicle-classifications" component={() => <VehicleClassificationList />} />
            <ProtectedRoute layout={Layout} exact path="/vehicle-classifications/create" component={() => <VehicleClassificationCreate />} />
            <ProtectedRoute layout={Layout} exact path="/vehicle-classifications/:id" component={(routeProps) =>
                <VehicleClassificationEdit
                    resource="vehicle-classifications"
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
        <Switch>
            <ProtectedRoute layout={Layout} exact path="/liqueur-zones" component={() => <ZoneList />} />
            <ProtectedRoute layout={Layout} exact path="/liqueur-zones/create" component={() => <ZoneCreate />} />
            <ProtectedRoute layout={Layout} exact path="/liqueur-zones/:id" component={(routeProps) =>
                <ZoneEdit
                    resource="liqueur-zones"
                    basePath={routeProps.match.url}
                    id={decodeURIComponent((routeProps.match).params.id)}
                    {...routeProps}
                />
            } />
        </Switch>
        <Switch>
            <ProtectedRoute layout={Layout} exact path="/liqueur-annexes" component={() => <AnnexList />} />
            <ProtectedRoute layout={Layout} exact path="/liqueur-annexes/create" component={() => <AnnexCreate />} />
            <ProtectedRoute layout={Layout} exact path="/liqueur-annexes/:id" component={(routeProps) =>
                <AnnexEdit
                    resource="liqueur-annexes"
                    basePath={routeProps.match.url}
                    id={decodeURIComponent((routeProps.match).params.id)}
                    {...routeProps}
                />
            } />
        </Switch>
    </>
)

export default App;
