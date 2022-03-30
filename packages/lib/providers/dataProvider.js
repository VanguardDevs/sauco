import apiClient from '@jodaz_/data-provider';
import CONFIG_NAMES from '../configs'

const providers = apiClient(`${process.env.REACT_APP_API_DOMAIN}/api`, {
  offsetPageNum: -1,
}, `${CONFIG_NAMES.AUTH_TOKEN}`);

export const dataProvider = providers.endpoints;

export const axios = providers.client;
