import React from 'react';
import PropTypes from 'prop-types';
import ReactLoading from 'react-loading';

import Row from './Row';

const Loading = ({ type, height, width  }) => 
<div className="d-flex justify-content-center">
  <ReactLoading
    color={'#646c9a'}
    type={type} 
    height={height} 
    width={width} 
  />
</div>

Loading.defaultProps = {
  type: 'spin',
  height: '5%',
  width: '5%'
};

export default Loading;
