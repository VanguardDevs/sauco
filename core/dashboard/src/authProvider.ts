import { AuthProvider } from 'react-admin';
import apiClient from './dataProvider';

const authProvider: AuthProvider = {
  login: async (data) => {
    await apiClient.get('csrf-cookie');
    const response = await apiClient.post('login', data);

    if (response.status < 200 || response.status >= 300) {
      throw new Error(response.statusText);
    } else {
      if (response.token) {
        await localStorage.setItem('saucoperms', response.permissions);
        await localStorage.setItem('saucoauth', response.token);
      }

      return Promise.resolve();
    }
  },
  logout: async () => {
    const response = await apiClient.post('logout');

    if (response.status < 200 || response.status >= 300) {
      throw new Error(response.statusText);
    } else {
      await localStorage.removeItem('saucoauth');

      return Promise.resolve();
    }
  },
  checkError: (error) => {
    const { response } = error;

    if (response.status === 401 || response.status === 403) {
      localStorage.removeItem('saucoauth');
      return Promise.reject({ message: false });
    }

    return Promise.resolve();
  },
  checkAuth: async () => await localStorage.getItem('saucoauth')
    ? Promise.resolve()
    : Promise.reject({ message: false }),
  getPermissions: () => Promise.reject('Unknown method'),
  getIdentity: async () => {
    const data = await apiClient.post('user/get');
    const { id, full_name, picture, ...rest } = data;

    return ({
      id: id,
      fullName: full_name,
      avatar: picture,
      ...rest
    });
  }
};

export default authProvider;
