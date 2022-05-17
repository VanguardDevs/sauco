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


// Status
import StatusList from './settings/status/StatusList'
import StatusCreate from './settings/status/StatusCreate'
import StatusEdit from './settings/status/StatusEdit'

// Liquidation Types
import LiquidationTypeList from './settings/liquidation-types/LiquidationTypeList'
import LiquidationTypeCreate from './settings/liquidation-types/LiquidationTypeCreate'
import LiquidationTypeEdit from './settings/liquidation-types/LiquidationTypeEdit'


// Payment Types
import PaymentTypeList from './settings/payment-types/PaymentTypeList'
import PaymentTypeCreate from './settings/payment-types/PaymentTypeCreate'
import PaymentTypeEdit from './settings/payment-types/PaymentTypeEdit'

// Ordinances
import OrdinanceList from './settings/ordinances/OrdinanceList'
import OrdinanceCreate from './settings/ordinances/OrdinanceCreate'
import OrdinanceEdit from './settings/ordinances/OrdinanceEdit'


// Petro Prices
import PetroPriceList from './settings/petro-prices/PetroPriceList'
import PetroPriceCreate from './settings/petro-prices/PetroPriceCreate'
import PetroPriceEdit from './settings/petro-prices/PetroPriceEdit'

// Representation Types
import RepresentationTypeList from './settings/representation-types/RepresentationTypeList'
import RepresentationTypeCreate from './settings/representation-types/RepresentationTypeCreate'
import RepresentationTypeEdit from './settings/representation-types/RepresentationTypeEdit'

// Charging Method
import ChargingMethodList from './settings/charging-methods/ChargingMethodList'
import ChargingMethodCreate from './settings/charging-methods/ChargingMethodCreate'
import ChargingMethodEdit from './settings/charging-methods/ChargingMethodEdit'

// Correlative Types
import CorrelativeTypeList from './settings/correlative-types/CorrelativeTypeList'
import CorrelativeTypeCreate from './settings/correlative-types/CorrelativeTypeCreate'
import CorrelativeTypeEdit from './settings/correlative-types/CorrelativeTypeEdit'

// Items
import ItemList from './settings/items/ItemList'
import ItemCreate from './settings/items/ItemCreate'
import ItemEdit from './settings/items/ItemEdit'

// Taxunits
import TaxUnitList from './settings/tax-units/TaxUnitList'

// Intervals
import IntervalList from './settings/intervals/IntervalList'
import IntervalCreate from './settings/intervals/IntervalCreate'
import IntervalEdit from './settings/intervals/IntervalEdit'


// Concepts
import ConceptList from './settings/concepts/ConceptList'
import ConceptCreate from './settings/concepts/ConceptCreate'
import ConceptEdit from './settings/concepts/ConceptEdit'

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
            <ProtectedRoute layout={Layout} exact path="/signatures" component={() => <SignatureList />} />
            <ProtectedRoute layout={Layout} exact path="/signatures/create" component={() => <SignatureCreate />} />
            <ProtectedRoute layout={Layout} exact path="/signatures/:id" component={(routeProps) =>
                <SignatureEdit
                    resource="signatures"
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
        <Switch>
            <ProtectedRoute layout={Layout} exact path="/status" component={() => <StatusList />} />
            <ProtectedRoute layout={Layout} exact path="/status/create" component={() => <StatusCreate />} />
            <ProtectedRoute layout={Layout} exact path="/status/:id" component={(routeProps) =>
                <StatusEdit
                    resource="status"
                    basePath={routeProps.match.url}
                    id={decodeURIComponent((routeProps.match).params.id)}
                    {...routeProps}
                />
            } />
        </Switch>
        <Switch>
            <ProtectedRoute layout={Layout} exact path="/liquidation-types" component={() => <LiquidationTypeList />} />
            <ProtectedRoute layout={Layout} exact path="/liquidation-types/create" component={() => <LiquidationTypeCreate />} />
            <ProtectedRoute layout={Layout} exact path="/liquidation-types/:id" component={(routeProps) =>
                <LiquidationTypeEdit
                    resource="liquidation-types"
                    basePath={routeProps.match.url}
                    id={decodeURIComponent((routeProps.match).params.id)}
                    {...routeProps}
                />
            } />
        </Switch>
        <Switch>
            <ProtectedRoute layout={Layout} exact path="/payment-types" component={() => <PaymentTypeList />} />
            <ProtectedRoute layout={Layout} exact path="/payment-types/create" component={() => <PaymentTypeCreate />} />
            <ProtectedRoute layout={Layout} exact path="/payment-types/:id" component={(routeProps) =>
                <PaymentTypeEdit
                    resource="payment-types"
                    basePath={routeProps.match.url}
                    id={decodeURIComponent((routeProps.match).params.id)}
                    {...routeProps}
                />
            } />
        </Switch>
        <Switch>
            <ProtectedRoute layout={Layout} exact path="/ordinances" component={() => <OrdinanceList />} />
            <ProtectedRoute layout={Layout} exact path="/ordinances/create" component={() => <OrdinanceCreate />} />
            <ProtectedRoute layout={Layout} exact path="/ordinances/:id" component={(routeProps) =>
                <OrdinanceEdit
                    resource="ordinances"
                    basePath={routeProps.match.url}
                    id={decodeURIComponent((routeProps.match).params.id)}
                    {...routeProps}
                />
            } />
        </Switch>
        <Switch>
            <ProtectedRoute layout={Layout} exact path="/petro-prices" component={() => <PetroPriceList />} />
            <ProtectedRoute layout={Layout} exact path="/petro-prices/create" component={() => <PetroPriceCreate />} />
            <ProtectedRoute layout={Layout} exact path="/petro-prices/:id" component={(routeProps) =>
                <PetroPriceEdit
                    resource="petro-prices"
                    basePath={routeProps.match.url}
                    id={decodeURIComponent((routeProps.match).params.id)}
                    {...routeProps}
                />
            } />
        </Switch>
        <Switch>
            <ProtectedRoute layout={Layout} exact path="/representation-types" component={() => <RepresentationTypeList />} />
            <ProtectedRoute layout={Layout} exact path="/representation-types/create" component={() => <RepresentationTypeCreate />} />
            <ProtectedRoute layout={Layout} exact path="/representation-types/:id" component={(routeProps) =>
                <RepresentationTypeEdit
                    resource="representation-types"
                    basePath={routeProps.match.url}
                    id={decodeURIComponent((routeProps.match).params.id)}
                    {...routeProps}
                />
            } />
        </Switch>
        <Switch>
            <ProtectedRoute layout={Layout} exact path="/charging-methods" component={() => <ChargingMethodList />} />
            <ProtectedRoute layout={Layout} exact path="/charging-methods/create" component={() => <ChargingMethodCreate />} />
            <ProtectedRoute layout={Layout} exact path="/charging-methods/:id" component={(routeProps) =>
                <ChargingMethodEdit
                    resource="charging-methods"
                    basePath={routeProps.match.url}
                    id={decodeURIComponent((routeProps.match).params.id)}
                    {...routeProps}
                />
            } />
        </Switch>
        <Switch>
            <ProtectedRoute layout={Layout} exact path="/correlative-types" component={() => <CorrelativeTypeList />} />
            <ProtectedRoute layout={Layout} exact path="/correlative-types/create" component={() => <CorrelativeTypeCreate />} />
            <ProtectedRoute layout={Layout} exact path="/correlative-types/:id" component={(routeProps) =>
                <CorrelativeTypeEdit
                    resource="correlative-types"
                    basePath={routeProps.match.url}
                    id={decodeURIComponent((routeProps.match).params.id)}
                    {...routeProps}
                />
            } />
        </Switch>
        <Switch>
            <ProtectedRoute layout={Layout} exact path="/items" component={() => <ItemList />} />
            <ProtectedRoute layout={Layout} exact path="/items/create" component={() => <ItemCreate />} />
            <ProtectedRoute layout={Layout} exact path="/items/:id" component={(routeProps) =>
                <ItemEdit
                    resource="items"
                    basePath={routeProps.match.url}
                    id={decodeURIComponent((routeProps.match).params.id)}
                    {...routeProps}
                />
            } />
        </Switch>
        <Switch>
            <ProtectedRoute layout={Layout} exact path="/tax-units" component={() => <TaxUnitList />} />
        </Switch>
        <Switch>
            <ProtectedRoute layout={Layout} exact path="/intervals" component={() => <IntervalList />} />
            <ProtectedRoute layout={Layout} exact path="/intervals/create" component={() => <IntervalCreate />} />
            <ProtectedRoute layout={Layout} exact path="/intervals/:id" component={(routeProps) =>
                <IntervalEdit
                    resource="intervals"
                    basePath={routeProps.match.url}
                    id={decodeURIComponent((routeProps.match).params.id)}
                    {...routeProps}
                />
            } />
        </Switch>
        <Switch>
            <ProtectedRoute layout={Layout} exact path="/concepts" component={() => <ConceptList />} />
            <ProtectedRoute layout={Layout} exact path="/concepts/create" component={() => <ConceptCreate />} />
            <ProtectedRoute layout={Layout} exact path="/concepts/:id" component={(routeProps) =>
                <ConceptEdit
                    resource="concepts"
                    basePath={routeProps.match.url}
                    id={decodeURIComponent((routeProps.match).params.id)}
                    {...routeProps}
                />
            } />
        </Switch>

    </>
)

export default App;
