import React from 'react';
import ReactDOM from 'react-dom';
// Components
import Row from '../../../components/Row';
import Col from '../../../components/Col';
import Create from './create';

const Withholdings = (props) => {
  return (
    <Col md='12'>
      <Create taxpayer={props.taxpayer}/>
    </Col>
  );
}

if (document.getElementById('withholdings')) {
  let taxpayer = document.getElementById('taxpayerID').getAttribute('data_id');
  ReactDOM.render(<Withholdings taxpayer={taxpayer} />, document.getElementById('withholdings')) 
}
