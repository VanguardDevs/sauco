import React from 'react';
import PropTypes from 'prop-types';

const classNames = {
  desktop: 'kt-header kt-grid__item  kt-header--fixed ',
  mobile: 'kt-header-mobile  kt-header-mobile--fixed ' 
}

const Header = ({ children, mobile }) => {
  return (
    <div className={mobile ? classNames.mobile : classNames.desktop}>
      {children}
    </div>
  );
}

Header.propTypes = {
  children: PropTypes.node,
  mobile: PropTypes.bool.isRequired
};

export default Header;
