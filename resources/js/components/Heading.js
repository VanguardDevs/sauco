import React from 'react';
import PropTypes from 'prop-types';

const Heading = ({ children }) => (
  <div className="kt-heading kt-heading--md">
    {children}
  </div>
);

Heading.propTypes = {
  children: PropTypes.node.isRequired
};

export default Heading;
