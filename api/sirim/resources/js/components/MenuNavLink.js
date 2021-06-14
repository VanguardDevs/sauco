import React, { useState } from 'react';
import { Link } from 'react-router-dom';
import PropTypes from 'prop-types';

const className = 'kt-menu__item--active';

const activeRoute = route => {
  return location.pathname === route ? "kt-menu__item--active" : '';
}

const MenuLink = ({ to, children }) => (
  <li className={"kt-menu__item  kt-menu__item--submenu kt-menu__item--rel " + activeRoute(to)}>
    <Link className="kt-menu__link kt-menu__toggle" to={to}>
      {children}
    </Link>
  </li>
);

MenuLink.propTypes = {
  to: PropTypes.string.isRequired,
  children: PropTypes.node 
};

export default MenuLink;
