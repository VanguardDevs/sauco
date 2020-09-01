import React from 'react';
import PropTypes from 'prop-types';

const defaultProps = {
  fluid: false,
  label: false,
  sublabel: false
};

const getClasses = (shouldFluid) => (
  (shouldFluid) ? 'kt-portlet kt-portlet--height-fluid' : 'kt-portlet'
);

const getPortletHeader = (label, sublabel) => (
  <div className="kt-portlet__head">
    <div className="kt-portlet__head-label">
      <h3 className="kt-portlet__head-title">
        {label}
        {
          (sublabel) ?
          <small>
          {sublabel}
          </small>
          : <></>
        }   
      </h3>  
    </div>
  </div>
);

const Portlet = (props) => {
  const {
    label,
    sublabel,
    children,
    fluid
  } = props;
  
  const header = (label) ? getPortletHeader(label, sublabel) : '';

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
