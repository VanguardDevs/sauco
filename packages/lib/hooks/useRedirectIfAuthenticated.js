import { useSelector } from 'react-redux';

export const useRedirectIfAuthenticated = (routes = null) => {
    const store = useSelector(state => state);
    const { isAuth } = store.user;

    const handleRedirection = () => {
        if (!isAuth && Array.isArray(routes)) {
            return routes.includes(window.location.pathname)
        }
    }

    return {
        redirect: handleRedirection(),
        isAuthenticated: isAuth
    };
};
