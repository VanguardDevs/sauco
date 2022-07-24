import * as React from 'react'
import { useAuth } from '../context/AuthContext'
import LoadingIndicator from './LoadingIndicator'

const PrivateRoute = ({ children, authorize = null, unauthorized: Unauthorized }) => {
    const { state: { user } } = useAuth();
    const [authorized, setAuthorized] = React.useState(null);

    React.useEffect(() => {
        if (authorize) {
            const authorizedRoles = authorize.split(',');
            const { roles } = user;
            const isAuthorized = roles.filter(
                role => authorizedRoles
                    .includes(role.toLowerCase())
            );

            setAuthorized(isAuthorized.length ? true : false)
        } else {
            setAuthorized(null)
        }
    }, [authorize])

    if (authorized == null) return <LoadingIndicator />;

    if (authorized == false) return Unauthorized;

    return children;
};

export default PrivateRoute
