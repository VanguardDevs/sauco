import React from 'react';
import PropTypes from 'prop-types';
import ReactLoading from 'react-loading';

const Loading = ({ type, height, width, color }) => 
<div className="d-flex justify-content-center">
  <ReactLoading
    color={color}
    type={type} 
    height={height} 
    width={width} 
  />
</div>

Loading.propTypes = {
  color: PropTypes.string,
};

Loading.defaultProps = {
  type: 'spin',
  height: '5%',
  width: '5%',
  color: '#646c9a'
};

export default Loading;
