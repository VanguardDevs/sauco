import axios from 'axios';
import {
  NOTIFY,
  GET_ERRORS,
  LOGOUT_USER,
  SET_CURRENT_USER,
  CLEAR_NOTIFICATION,
  CLEAR_ERRORS
} from './types';
import { setAuthToken, history } from '../utils';

export const recoverAccount = data => dispatch => {
  axios.post('/api/recover-account', data)
    .then(res => history.push('/check-email'))
    .catch(err => dispatch(setErrors(err.response.data.errors)));
}

export const resetPassword = data => dispatch => {
  axios.post('/api/reset-password', data)
    .then(res => history.push('/login'))
    .catch(err => dispatch(setErrors(err.response.data.errors)));
}

export const registerUser = data => dispatch => {
  axios.post('/api/users', data)
    .then(res => console.log(res.data))
    .catch(err => dispatch(setErrors(err.response.data.errors)));
}

export const login = data => dispatch => {
  axios.post('/api/login', data)
    .then(res => {
      const { token } = res.data;

      localStorage.setItem('sasi', token);
      setAuthToken(token);

      history.push('/home');
      dispatch(setUser(res.data.user));
      dispatch(clearErrors());
    })
    .catch(err => dispatch(setErrors(err.response.data.errors)));
}

export const logout = () => dispatch => {
  axios.get('/api/logout')
    .then(res => {
      localStorage.removeItem('sasi');
      setAuthToken();
      history.push('/login');
      dispatch({
        type: LOGOUT_USER
      });
    })
    .catch(err => dispatch(setErrors(err.response.data.errors)));
}

export const getUser = () => dispatch => {
  axios.get('/api/user')
    .then( res => dispatch(setUser(res.data)))
    .catch(err => {
      if (err.response.status) {
        localStorage.removeItem('sasi');
        history.push('/login');
      }

      dispatch(setErrors(err.response.data.errors));
    });
};

export const setUser = user => ({
  type: SET_CURRENT_USER,
  payload: user
});

export const createCategory = data => dispatch => {
  axios.post('/api/categories', data)
    .then(res => {
      history.goBack();
      dispatch(makeNotification(res.data));
    })
    .catch(err => dispatch(setErrors(err.response.data.errors)));
}

export const createApplication = data => dispatch => {
  axios.post('/api/applications', data)
    .then(res => {
      history.goBack();
      dispatch(makeNotification(res.data))
      dispatch(clearErrors());
    })
    .catch(err => dispatch(setErrors(err.response.data.errors)));
}

export const createCommunity = data => dispatch => {
  axios.post('/api/communities', data)
    .then(res => {
      history.goBack();
      dispatch(makeNotification(res.data))
      dispatch(clearErrors());
    })
    .catch(err => dispatch(setErrors(err.response.data.errors)));
}

export const clearNotification = () => ({
  type: CLEAR_NOTIFICATION
}); 

export const clearErrors = () => ({
  type: CLEAR_ERRORS
});

const setErrors = payload => ({
  type: GET_ERRORS,
  payload: payload
});

const makeNotification = (response) => ({
  type: NOTIFY,
  payload: response
});
