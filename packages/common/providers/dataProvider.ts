import apiClient from 'ra-laravel-client';

console.log(process.env.REACT_APP_API_DOMAIN)

export const dataProvider = apiClient(`${process.env.REACT_APP_API_DOMAIN}/api`);
