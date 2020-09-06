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
  axios.post('/recover-account', data)
    .then(res => history.push('/check-email'))
    .catch(err => dispatch(setErrors(err.response.data.errors)));
}

export const resetPassword = data => dispatch => {
  axios.post('/reset-password', data)
    .then(res => history.push('/signin'))
    .catch(err => dispatch(setErrors(err.response.data.errors)));
}

export const registerUser = data => dispatch => {
  axios.post('/users', data)
    .then(res => console.log(res.data))
    .catch(err => dispatch(setErrors(err.response.data.errors)));
}

export const login = data => dispatch => {
  axios.post('/signin', data)
    .then(res => {
      const { token } = res.data;

      localStorage.setItem('sauco', token);
      setAuthToken(token);

      history.push('/home');
      dispatch(setUser(res.data.user));
      dispatch(clearErrors());
    })
    .catch(err => dispatch(setErrors(err.response.data)));
}

export const logout = () => dispatch => {
  axios.get('/logout')
    .then(res => {
      history.push('/signin');
      localStorage.removeItem('sauco');
      setAuthToken();
      dispatch(setUser({}));
    })
    .catch(err => dispatch(setErrors(err.response.data.errors)));
}

export const getUser = () => dispatch => {
  axios.get('/user')
    .then( res => dispatch(setUser(res.data)))
    .catch(err => {
      if (err.response.status) {
        localStorage.removeItem('sauco');
        history.push('/signin');
      }

      dispatch(setErrors(err.response.data.errors));
    });
};

export const setUser = user => ({
  type: SET_CURRENT_USER,
  payload: user
});

export const createCategory = data => dispatch => {
  axios.post('/categories', data)
    .then(res => {
      history.goBack();
      dispatch(makeNotification(res.data));
    })
    .catch(err => dispatch(setErrors(err.response.data.errors)));
}

export const createApplication = data => dispatch => {
  axios.post('/applications', data)
    .then(res => {
      history.goBack();
      dispatch(makeNotification(res.data))
      dispatch(clearErrors());
    })
    .catch(err => dispatch(setErrors(err.response.data.errors)));
}

export const createCommunity = data => dispatch => {
  axios.post('/communities', data)
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
