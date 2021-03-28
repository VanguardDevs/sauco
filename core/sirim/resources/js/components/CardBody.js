import React from 'react';
import PropTypes from 'prop-types';

const CardBody = ({ children }) => (
  <div className="card-body">
    {children}
  </div>
);

CardBody.propTypes = {
  children: PropTypes.node
};

export default CardBody;
