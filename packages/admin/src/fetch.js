import axios from 'axios';
import React from 'react';
//import { history, setAuthToken } from './utils';
import { apiURL } from './config';

const getErrors = (error) => {
  let errors = {};

  if (error.request) {
    errors = { ...error.request };
  }
  if (error.response) {
    errors = { ...error.response.data };
  }
  if (error.message) {
    errors = { ...error.message.errors };
  }

  return errors;
}

export const postRequest = (data, route) =>
  axios.post(`${apiURL}/${route}`, data)
    .then(res => ({ response: res.data }))
    .catch(err => ({ error: getErrors(err) }));

export const getRequest = route =>
  axios.get(`${apiURL}/${route}`)
    .then(res => ({ response: res.data }))
    .catch(err => ({ error: getErrors(err) }));

export const logout = () =>
  axios.get(`${apiURL}/logout`)
    .then(res => ({ response: res.data }))
    .catch(err => ({ error: getErrors(err) }));
 
export const useFetch = (url) => {
  const [response, setResponse] = React.useState(null);
  const [error, setError] = React.useState(null);
  const [isLoading, setIsLoading] = React.useState(true);

  React.useEffect(() => {
    const fetchData = async () => {
      setIsLoading(true);
      try {
        const res = await getRequest(url); 
        setResponse(res.response);
        setIsLoading(false)
      } catch (error) {
        setError(error);
      }
    };
    fetchData();
  }, []);

  return { response, error, isLoading  };
};

