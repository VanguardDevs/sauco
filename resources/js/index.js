import React, { useState, useEffect } from 'react';
import ReactDOM from 'react-dom';
import { setAuthToken } from './utils';
import axios from 'axios';

const App = () => {
  if (!localStorage.sauco) {
    axios.get('authenticate')
      .then(res => {
        localStorage.setItem('sauco', res.data.token);
        setAuthToken(localStorage.sauco);
      })
      .catch(res => console.log(res.data));
  } else {
    setAuthToken(localStorage.sauco);
  }

  return <></>;
}

if (document.getElementById('root')) {
  ReactDOM.render(<App />, document.getElementById('root'));
}

