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

// Signatures
import SignatureList from './settings/signatures/SignatureList'
import SignatureCreate from './settings/signatures/SignatureCreate'
import SignatureEdit from './settings/signatures/SignatureEdit'

// Vehicle Classifications
import VehicleClassificationList from './settings/vehicle-classifications/VehicleClassificationList'
import VehicleClassificationCreate from './settings/vehicle-classifications/VehicleClassificationCreate'
import VehicleClassificationEdit from './settings/vehicle-classifications/VehicleClassificationEdit'


// Vehicle Parameters
import VehicleParameterList from './settings/vehicle-parameters/VehicleParameterList'
import VehicleParameterCreate from './settings/vehicle-parameters/VehicleParameterCreate'
import VehicleParameterEdit from './settings/vehicle-parameters/VehicleParameterEdit'

// Liqueur Zones
import ZoneList from './settings/zones/ZoneList'
import ZoneCreate from './settings/zones/ZoneCreate'
import ZoneEdit from './settings/zones/ZoneEdit'

// Liqueur Annexes
import AnnexList from './settings/annexes/AnnexList'
import AnnexCreate from './settings/annexes/AnnexCreate'
import AnnexEdit from './settings/annexes/AnnexEdit'

// Liqueur Classifications
import LiqueurClassificationList from './settings/liqueur-classifications/LiqueurClassificationList'
import LiqueurClassificationCreate from './settings/liqueur-classifications/LiqueurClassificationCreate'
import LiqueurClassificationEdit from './settings/liqueur-classifications/LiqueurClassificationEdit'

// Liqueur Parameters
import LiqueurParameterList from './settings/liqueur-parameters/LiqueurParameterList'
import LiqueurParameterCreate from './settings/liqueur-parameters/LiqueurParameterCreate'
import LiqueurParameterEdit from './settings/liqueur-parameters/LiqueurParameterEdit'



// Years
import YearList from './settings/years/YearList'
import YearCreate from './settings/years/YearCreate'
import YearEdit from './settings/years/YearEdit'

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

            <ProtectedRoute
                layout={Layout}
                exact
                path="/signatures"
                component={(routeProps) =>
                    <SignatureList
                        resource="signatures"
                        basePath={routeProps.match.url}
                    />
                }
            />
            <ProtectedRoute
                layout={Layout}
                exact
                path="/signatures/create"
                component={(routeProps) =>
                    <SignatureCreate
                        resource="signatures"
                        basePath={routeProps.match.url}
                    />
                }
            />
            <ProtectedRoute
                layout={Layout}
                exact
                path="/signatures/:id"
                component={(routeProps) =>
                    <SignatureEdit
                        resource="signatures"
                        basePath={routeProps.match.url}
                        id={decodeURIComponent((routeProps.match).params.id)}
                        {...routeProps}
                    />
                }
            />
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
            <ProtectedRoute layout={Layout} exact path="/vehicle-models" component={() => <ModelList />} />
            <ProtectedRoute layout={Layout} exact path="/vehicle-models/create" component={() => <ModelCreate />} />
            <ProtectedRoute layout={Layout} exact path="/vehicle-models/:id" component={(routeProps) =>
                <ModelEdit
                    resource="vehicle-models"
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
        <Switch>
            <ProtectedRoute layout={Layout} exact path="/liqueur-classifications" component={() => <LiqueurClassificationList />} />
            <ProtectedRoute layout={Layout} exact path="/liqueur-classifications/create" component={() => <LiqueurClassificationCreate />} />
            <ProtectedRoute layout={Layout} exact path="/liqueur-classifications/:id" component={(routeProps) =>
                <LiqueurClassificationEdit
                    resource="liqueur-classifications"
                    basePath={routeProps.match.url}
                    id={decodeURIComponent((routeProps.match).params.id)}
                    {...routeProps}
                />
            } />
        </Switch>
        <Switch>
            <ProtectedRoute layout={Layout} exact path="/liqueur-parameters" component={() => <LiqueurParameterList />} />
            <ProtectedRoute layout={Layout} exact path="/liqueur-parameters/create" component={() => <LiqueurParameterCreate />} />
            <ProtectedRoute layout={Layout} exact path="/liqueur-parameters/:id" component={(routeProps) =>
                <LiqueurParameterEdit
                    resource="liqueur-parameters"
                    basePath={routeProps.match.url}
                    id={decodeURIComponent((routeProps.match).params.id)}
                    {...routeProps}
                />
            } />
        </Switch>

        <Switch>
            <ProtectedRoute layout={Layout} exact path="/years" component={() => <YearList />} />
            <ProtectedRoute layout={Layout} exact path="/years/create" component={() => <YearCreate />} />
            <ProtectedRoute layout={Layout} exact path="/years/:id" component={(routeProps) =>
                <YearEdit
                    resource="years"
                    basePath={routeProps.match.url}
                    id={decodeURIComponent((routeProps.match).params.id)}
                    {...routeProps}
                />
            } />
        </Switch>

    </>
)

export default App;
