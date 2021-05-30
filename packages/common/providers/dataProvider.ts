import apiClient from 'ra-laravel-client';

const dataProvider = apiClient(`${process.env.REACT_APP_API_DOMAIN}`, {
  withCredentials: true
}, 'saucosauth');

const customDataProvider = {
  ...dataProvider
};

export default customDataProvider;
