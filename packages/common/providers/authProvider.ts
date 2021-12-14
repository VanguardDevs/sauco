import { AuthProvider } from 'react-admin';
import { axios } from './dataProvider'

const CONFIG_NAMES = {
    IDENTIFICATION: `${process.env.REACT_APP_IDENTIFICATIONS_NAME}`,
    AUTH_TOKEN: `${process.env.REACT_APP_AUTH_TOKEN_NAME}`,
    PERMISSIONS: `${process.env.REACT_APP_PERMISSIONS_NAME}`,
}

export const authProvider: AuthProvider = {
    login: async (data) => {
        await axios.get('csrf-cookie')
        const response = await axios.post('login', data);

        if (response.status < 200 || response.status >= 300) {
            throw new Error(response.statusText);
        } else {
            const { data } = response

            if (data.token) {
                await localStorage.setItem(CONFIG_NAMES.IDENTIFICATION, data.user);
                await localStorage.setItem(CONFIG_NAMES.AUTH_TOKEN, data.token);
                await localStorage.setItem(CONFIG_NAMES.PERMISSIONS, data.permissions);
            }

            return Promise.resolve(data);
        }
    },
    logout: async () => {
        await axios.get('logout');
        await localStorage.removeItem(CONFIG_NAMES.AUTH_TOKEN);
        await localStorage.removeItem(CONFIG_NAMES.IDENTIFICATION);
        await localStorage.removeItem(CONFIG_NAMES.PERMISSIONS);

        return Promise.resolve();
    },
    checkError: async (error) => {
        const { response } = error;

        if (response.status === 401 || response.status === 403) {
            await localStorage.removeItem(CONFIG_NAMES.AUTH_TOKEN);
            await localStorage.removeItem(CONFIG_NAMES.IDENTIFICATION);
            await localStorage.removeItem(CONFIG_NAMES.PERMISSIONS);

            return Promise.reject();
        }

        return Promise.resolve();
    },
    checkAuth: async () => {
        const token = await localStorage.getItem(CONFIG_NAMES.AUTH_TOKEN)
        if (token) return Promise.resolve()
        return Promise.reject()
    },
    getPermissions: async () => {
        const permissions = await localStorage.getItem(CONFIG_NAMES.PERMISSIONS);

        return permissions ? Promise.resolve(permissions) : Promise.resolve('guest');
    },
    getIdentity: async () => {
        const token = await localStorage.getItem(CONFIG_NAMES.IDENTIFICATION);

        if (token) {
            const { id, full_name, picture, ...rest } = JSON.parse(token);

            return ({
                id: id,
                full_name: full_name,
                avatar: picture,
                ...rest
            });
        }
    }
};

