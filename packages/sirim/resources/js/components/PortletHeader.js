import React from 'react';
import PropTypes from 'prop-types';

const PortletHeader = ({ label, sublabel, children }) => (
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
    {children}
  </div>
);

PortletHeader.propTypes = {
  label: PropTypes.string,
  sublabel: PropTypes.string,
  children: PropTypes.node
};

export default PortletHeader;
