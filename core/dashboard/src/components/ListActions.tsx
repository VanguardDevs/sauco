import * as React from 'react';
import {
  TopToolbar,
  useListContext,
  sanitizeListRestProps,
  CreateButton
} from 'react-admin';
import {
  makeStyles,
} from '@material-ui/core';

const useStyles = makeStyles(theme => ({
  toolbar: {
    backgroundColor: 'transparent'
  },
  createButton: {
    textTransform: 'capitalize',
    color: theme.palette.primary.light,
    padding: '0.2rem 1rem',
    textAlign: 'center',
    backgroundColor: theme.palette.error.main,
    borderRadius: '0',
    fontSize: '14px',
    '&:hover': {
      color: theme.palette.primary.dark
    }
  }
}));

const ListActions: React.FC<any> = props => {
  const {
    filters,
    createLabel,
    customBasePath,
    handleClick,
    ...rest
  } = props;
  const {
    resource,
    displayedFilters,
    filterValues,
    basePath,
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
      <CreateButton
        basePath={basePath}
        className={classes.createButton}
        label={createLabel}
        onClick={handleClick}
      />
    </TopToolbar>
  );
}

export default ListActions;
