import apiClient from '@jodaz_/data-provider';

export const dataProvider = apiClient(`${process.env.REACT_APP_API_DOMAIN}`, {
    withCredentials: true,
    offsetPageNum: 0
}, `${process.env.REACT_APP_AUTH_TOKEN_NAME}`);
