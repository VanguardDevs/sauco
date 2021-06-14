import { makeStyles, Typography, CircularProgress } from '@material-ui/core';
import { useListContext } from 'react-admin';

const useStyles = makeStyles(theme => ({
  root: {
    display: 'flex',
    alignItems: 'center',
    justifyContent: 'center',
    backgroundColor: theme.palette.secondary.light,
    width: '12rem',
    height: '6rem',
    padding: '1rem',
    flexDirection: 'column',
    borderRadius: '5px'
  }
}));

const TotalCount: React.FC<any> = props => {
  const { loaded, total } = useListContext(props);

  const classes = useStyles();

  return (
    <div className={classes.root}>
      { !loaded
        ? <CircularProgress />
        : (
        <>
          <Typography variant='subtitle1' component='h1'>
            {props.title}
          </Typography>
          <Typography variant='h3' component='h1'>
            {total}
          </Typography>
        </>
      )}
    </div>
  );
}

export default TotalCount;
