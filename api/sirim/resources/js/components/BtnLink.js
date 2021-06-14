import React from 'react';
import { Link } from 'react-router-dom';
import PropTypes from 'prop-types';

const BtnLink = ({ to, children, styles }) => (
  <Link className={'btn '+styles} to={to}>
    {children} 
  </Link>
);

BtnLink.propTypes = {
  to: PropTypes.string.isRequired,
  styles: PropTypes.string.isRequired,
  children: PropTypes.node,
};

export default BtnLink;
