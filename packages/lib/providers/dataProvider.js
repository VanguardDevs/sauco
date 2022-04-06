import apiClient from '@jodaz_/data-provider';
import CONFIG_NAMES from '../configs'

const providers = apiClient(`${CONFIG_NAMES.SOURCE}`, {
  offsetPageNum: -1,
  withCredentials: true
}, `${CONFIG_NAMES.AUTH_TOKEN}`);

export const dataProvider = providers.endpoints;

export const axios = providers.client;
