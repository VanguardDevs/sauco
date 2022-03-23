import React from 'react';
import PropTypes from 'prop-types';

const getClasses = (shouldFluid) => (
  (shouldFluid) ? 'kt-portlet kt-portlet--height-fluid' : 'kt-portlet'
);

const Portlet = (props) => {
  const {
    children,
    fluid
  } = props;
  
  const classes = getClasses(fluid);

  return (
    <div className={classes}>
      {children}
    </div>
  );
} 

Portlet.propTypes = {
  children: PropTypes.node.isRequired,
  isFluid: PropTypes.bool
};

Portlet.defaultProps = {
  fluid: false,
};

export default Portlet;
