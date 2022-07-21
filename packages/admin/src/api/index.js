import defaultAxios from 'axios';
import CONFIG_NAMES from '../configs'

const instance = defaultAxios.create({
    baseURL: CONFIG_NAMES.SOURCE,
    withCredentials: true
});

// Request interceptor
instance.interceptors.request.use(
    (config) => {
        const token = localStorage.getItem(CONFIG_NAMES.AUTH_TOKEN);

        const newConfig = config;

        // When a 'token' is available set as token.
        if (token) {
            newConfig.headers.Authorization = `Bearer ${token}`;
        }

        return newConfig;
    },
    (err) => Promise.reject(err),
);

export default instance
