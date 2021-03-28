import React from 'react';
import PropTypes from 'prop-types';

const PortletBody = ({ children }) => (
  <div className="kt-portlet__body">
    {children}
  </div>
);

PortletBody.propTypes = {
  children: PropTypes.node.isRequired
};

export default PortletBody;
