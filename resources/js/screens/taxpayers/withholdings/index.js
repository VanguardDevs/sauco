import React from 'react';
import ReactDOM from 'react-dom';
// Components
import Row from '../../../components/Row';
import Col from '../../../components/Col';
import Create from './create';

const Withholdings = (props) => {
  return (
    <Col md='12'>
      <Create
        taxpayer={props.taxpayer}
        user={props.user}
      />
    </Col>
  );
}

if (document.getElementById('withholdings')) {
  let taxpayer = document.getElementById('data');

  ReactDOM.render(
    <Withholdings 
      taxpayer={data.getAttribute('data-taxpayer-id')}
      user={data.getAttribute('data-user-id')}
    />, document.getElementById('withholdings')) 
}
