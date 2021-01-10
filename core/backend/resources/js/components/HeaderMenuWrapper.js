import React, { useState } from 'react';
import PropTypes from 'prop-types';

const HeaderMenuWrapper = ({ children }) => (
  <div className="kt-header-menu-wrapper">
    {children}
  </div>
);

HeaderMenuWrapper.propTypes = {
  children: PropTypes.node
};

export default HeaderMenuWrapper;
