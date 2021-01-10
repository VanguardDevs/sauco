import React, { useState, useEffect } from 'react';
import ReactDOM from 'react-dom';
import redux from 'redux';
import { Provider, useDispatch } from 'react-redux';
import Loading from './components/Loading';
import store from './store';
import { getUser } from './store/actions';

const App = () => {
  const [loading, setLoading] = useState(true);
  const dispatch = useDispatch();

  useEffect(() => {
    dispatch(getUser());
  }, []);

  return <Loading />;
}

if (document.getElementById('root')) {
  ReactDOM.render(
    <Provider store={store}>
      <App />
    </Provider>, 
    document.getElementById('root')
  );
}

