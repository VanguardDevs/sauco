import CONFIG_NAMES from '../configs'

export const authProvider = () => ({
    login: () => Promise.resolve(),
    logout: () => Promise.resolve(),
    checkError: async (error) => {
        const { response } = error;

        if (response.status === 401 || response.status === 403) {
            await localStorage.removeItem(CONFIG_NAMES.AUTH_TOKEN);
        }

        return Promise.resolve();
    },
    checkAuth: async (packageName) => {
        const token = await localStorage.getItem(CONFIG_NAMES.AUTH_TOKEN);

        if (!token) {
            return (packageName == 'app')
                ? window.location.href = `${CONFIG_NAMES.REDIRECT_TO}`
                : Promise.reject({ redirectTo: '/login' })
        }

        return Promise.resolve()
    },
    getPermissions: () => Promise.resolve(),
    getIdentity: () => Promise.resolve()
});
