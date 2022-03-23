import * as React from 'react';
import {
  Typography,
  Grid,
  makeStyles,
  Box
} from '@material-ui/core';

interface Props {
  title: string,
  children: React.ReactChild
};

const useStyles = makeStyles(theme => ({
  root: {
    padding: theme.spacing(2)
  }
}));

const ListWrapper: React.FC<Props> = ({
  title,
  children
}) => {
  const classes = useStyles();

  return (
    <Grid className={classes.root}>
      <Typography component={'h1'} variant='h4'>
        {title}
      </Typography>
      
      <Box mt={2}>
        {children}
      </Box>
    </Grid>
  );
}

export default ListWrapper;