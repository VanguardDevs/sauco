import React, { useState, useEffect } from 'react';
import ReactDOM from 'react-dom';
import redux from 'redux';
import { Provider } from 'react-redux';
import Loading from './components/Loading';
import store from './store';

const App = () => {
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    window.location.replace('/dashboard');
  }, []);

  return <Loading />;
}

if (document.getElementById('root')) {
  ReactDOM.render(<App />, document.getElementById('root'));
}

