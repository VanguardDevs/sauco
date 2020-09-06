import React from 'react';
import ReactDOM from 'react-dom';
import redux from 'redux';
import { Provider, useDispatch } from 'react-redux';
import Loading from './components/Loading';
import { store, Actions } from './store';
import * as Store from './store';
import App from './screens';
import { history, setAuthToken } from './utils';
import Helmet from 'react-helmet';

const Index = () => {
  const dispatch = useDispatch();
  /**
   * Authentication things
  **/
  if (location.pathname === '/') history.push('/home');
  if (localStorage.sauco) {
    setAuthToken(localStorage.sauco);
    dispatch(Actions.getUser());
  } 

  return (
    <>
      <Helmet titleTemplate="%s - Sauco"/>

      <App />
    </>
  );
}

if (document.getElementById('root')) {
  ReactDOM.render(
    <Provider store={store}>
      <Index />
    </Provider>, 
    document.getElementById('root')
  );
}

