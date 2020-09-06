import React from 'react';
import Container from '@material-ui/core/Container';
import Navigation from './Navigation'; 
import Helmet from 'react-helmet';

export default function Layout({ title, children }) {
  return (<>
    <Helmet title={title} />

    <Navigation />
    <Container component="main" maxWidth="xs">
      {children}    
    </Container>
  </>);
};

