import React from 'react';
import ReactDOM from 'react-dom';
import App from './App';
import customReducers from '@sauco/lib/reducers'
import createAdminStore from '@sauco/lib/store'
import { Provider } from 'react-redux'
import { DataProviderContext, Resource } from 'react-admin'
import { dataProvider, history } from '@sauco/lib/providers'
import customSagas from '@sauco/lib/sagas'
import { ConnectedRouter } from 'connected-react-router';
import { ThemeProvider, createTheme } from '@material-ui/core/styles';
import { theme } from '@sauco/lib/styles';
import './index.css';

const Index = () => (
    <Provider store={createAdminStore({
        dataProvider,
        history,
        customReducers,
        customSagas
    })}>
        <DataProviderContext.Provider value={dataProvider}>
            <Resource name='dashboard' intent="registration" />
            <Resource name='colors' intent="registration" />

            <ConnectedRouter history={history}>
                <ThemeProvider theme={createTheme(theme)}>
                    <App />
                </ThemeProvider>
            </ConnectedRouter>
        </DataProviderContext.Provider>
    </Provider>
);

ReactDOM.render(
  <React.StrictMode>
    <Index />
  </React.StrictMode>,
  document.getElementById('root')
);
