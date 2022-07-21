import * as React from 'react'
import { Navigate } from 'react-router-dom'
import { useAuth } from '../context/AuthContext'

const AuthenticatedRoute = ({ children }) => {
    const { state: { isAuth } } = useAuth();

    if (!isAuth) return <Navigate to='/login' />;

    return children;
};

export default AuthenticatedRoute