import React from 'react';
import ReactDOM from 'react-dom';
// Components
import Row from '../../../components/Row';
import Col from '../../../components/Col';
import Create from './create';

const Withholdings = () => {
  return (
    <Col md='12'>
      <Create />
    </Col>
  );
}

if (document.getElementById('withholdings')) {
  ReactDOM.render(<Withholdings />, document.getElementById('withholdings')); 
}
