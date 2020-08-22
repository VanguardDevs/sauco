import React, { useState } from 'react';
import PropTypes from 'prop-types';

const HeaderTopBar = ({ children }) => (
  <div className="kt-header__topbar">
    {children}
  </div>
);

HeaderTopBar.propTypes = {
  children: PropTypes.node
};

export default HeaderTopBar;
