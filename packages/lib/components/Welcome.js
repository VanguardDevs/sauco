import React from 'react';
import {
  makeStyles,
  Typography,
  Card,
  CardHeader,
  CardContent,
} from '@material-ui/core';

const useStyles = makeStyles({
  welcome: {
    width: '100%'
  },
  title: {
    fontSize: 18,
  }
});

export default function Welcome({ title }) {
  const classes = useStyles();

  return (
    <Card className={classes.welcome} spacing={5}>
      <CardContent >
        <Typography className={classes.title} color="textPrimary" variant="subtitle1" gutterBottom>
          {title}
        </Typography>
      </CardContent>
    </Card>
  );
};

