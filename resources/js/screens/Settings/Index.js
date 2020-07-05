import React from 'react';
import ReactDOM from 'react-dom';
// Components
import Notification from '../../components/Notification';
import Portlet from '../../components/Portlet';

const Index = () => {
   
  return (
    <p>Hello World</p>
  );
}

if (document.getElementById('settings-screen')) {
  ReactDOM.render(<Index />, 'settings-screen');
}
