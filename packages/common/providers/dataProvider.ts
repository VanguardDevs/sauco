import apiClient from 'ra-laravel-client';

export const dataProvider = apiClient(`${process.env.REACT_APP_API_DOMAIN}`, {
    withCredentials: true
}, `${process.env.REACT_APP_AUTH_TOKEN_NAME}`);
