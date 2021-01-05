import React from 'react';
import PropTypes from 'prop-types';

const Label = ({ text, required }) => (
  <label className="kt-portlet__head">
    {text}
    { (required) ? <span className="text-danger"> * </span> : <></> }
  </label>
);

Label.propTypes = {
  text: PropTypes.string.isRequired,
};

Label.defaultProps = {
  required: false
};

export default Label;
