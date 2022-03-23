import React  from 'react';
import PropTypes from 'prop-types';

const PortletToolbar = ({ children }) => (
  <div className='kt-portlet__head-toolbar'>
    <div className='kt-portlet__head-group'>
      {children}
    </div>
  </div>
);

PortletToolbar.propTypes = {
  children: PropTypes.node.isRequired
};

export default PortletToolbar;
