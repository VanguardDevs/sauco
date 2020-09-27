import * as React from 'react';
import * as ReactDOM from 'react-dom';
import Helmet from 'react-helmet';

import { App } from './App';

const Index = () => (
  <>
    <Helmet titleTemplate="%s - Sauco" />

    <App />
  </>
);

ReactDOM.render(
  <Index />,
  document.getElementById('root')
);
