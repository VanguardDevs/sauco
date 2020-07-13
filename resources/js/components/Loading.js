import React from 'react';
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

export default Loading;
