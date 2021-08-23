import React from 'react';
import PropTypes from 'prop-types';

const PortletFooter = ({ children }) => (
  <div className="kt-portlet__foot">
    {children}
  </div>
);

PortletFooter.propTypes = {
  children: PropTypes.node
};

export default PortletFooter;
