import React, { useState } from 'react';
import { Link } from 'react-router-dom';
import PropTypes from 'prop-types';

const HeaderLogo = ({ children, to }) => (
  <div className="kt-header-mobile__logo">
    <Link to={to}>
      {children}
    </Link>
  </div>
);

HeaderLogo.propTypes = {
  children: PropTypes.node,
  to: PropTypes.string.isRequired
};

export default HeaderLogo;
