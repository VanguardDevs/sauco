import React from "react";
import { Redirect, Route } from "react-router-dom";
import CONFIG_NAMES from '../configs'

function ProtectedRoute({ component: Component, layout: Layout, ...restOfProps }) {
    const isAuthenticated = localStorage.getItem(CONFIG_NAMES.AUTH_TOKEN);

    return (
        <Route
            {...restOfProps}
            render={(props) =>
                isAuthenticated
                ? (
                    <Layout>
                        <Component {...props} />
                    </Layout>
                ) : <Redirect to="/login" />
            }
        />
    );
}

export default ProtectedRoute;
