import React from 'react';
import ReactDOM from 'react-dom';
import redux from 'redux';
import { Provider, useDispatch } from 'react-redux';
import Loading from './components/Loading';
import { store } from './store';
import * as Store from './store';
import App from './screens';
import { history } from './utils';
import Helmet from 'react-helmet';

const Index = () => {
  /**
   * Authentication things
  **/
  if (localStorage.sauco) {
    history.push('/home');
  } else {
    history.push('/signin');
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

