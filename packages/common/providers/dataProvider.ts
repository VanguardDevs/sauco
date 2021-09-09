import apiClient from 'ra-laravel-client';

export const dataProvider = apiClient(`${process.env.REACT_APP_API_DOMAIN}`, {
    withCredentials: true
}, 'sauco_auth_local');
