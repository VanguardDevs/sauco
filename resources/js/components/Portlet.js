import React from 'react';
import PropTypes from 'prop-types';

const defaultProps = {
  fluid: false,
  label: false
};

const getClasses = (shouldFluid) => (
  (shouldFluid) ? 'kt-portlet kt-portlet--height-fluid' : 'kt-portlet'
);

const getPortletHeader = (label) => (
  <div className="kt-portlet__head">
    <div className="kt-portlet__head-label">
      <h3 className="kt-portlet__head-title">{label}</h3>
    </div>
  </div>
);

const Portlet = (props) => {
  const {
    label,
    children,
    fluid
  } = props;
  
  const header = (label) ? getPortletHeader(label) : '';

  const classes = getClasses(fluid);

  return (
    <div className={classes}>
      {header}
      <div className="kt-portlet__body">
        {children}
      </div>
    </div>
  );
} 

Portlet.defaultProps = defaultProps;

export default Portlet;
