import React from 'react';
import Navigation from './Navigation'; 
import Helmet from 'react-helmet';
import {
  Container,
  makeStyles,
  useTheme,
  Grid
} from '@material-ui/core';

const useStyles = makeStyles((theme) => ({
  container: {
    width: "75%",
    marginLeft: "25%"
  }
}));

export default function Layout({ title, children }) {
  const classes = useStyles();

  return (<>
    <Helmet title={title} />

    <Container component="main" className={classes.container}>
      <Navigation />
      <Grid item xs={12}>
        {children}    
      </Grid>
    </Container>
  </>);
};

