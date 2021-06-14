import * as React from 'react';
import {
  TopToolbar,
  useListContext,
  sanitizeListRestProps
} from 'react-admin';
import {
  makeStyles,
} from '@material-ui/core';

const useStyles = makeStyles(theme => ({
  toolbar: {
    backgroundColor: 'transparent'
  }
}));

const ListActions: React.FC<any> = props => {
  const {
    filters,
    createLabel,
    customBasePath,
    children,
    ...rest
  } = props;
  const {
    resource,
    displayedFilters,
    filterValues,
    showFilter,
  } = useListContext();
  const classes = useStyles();

  return (
    <TopToolbar className={classes.toolbar} {...sanitizeListRestProps(rest)}>
      {filters && React.cloneElement(filters, {
        resource,
        showFilter,
        displayedFilters,
        filterValues,
        context: 'button',
      })}
      {React.Children.map(children, child => (
        React.cloneElement(child, {...props})
      ))}
    </TopToolbar>
  );
}

export default ListActions;
