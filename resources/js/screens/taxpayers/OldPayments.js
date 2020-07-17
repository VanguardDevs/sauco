import React from 'react';
import ReactDOM from 'react-dom';
import { useForm } from 'react-hook-form';
import axios from 'axios';

// Components
import Col from '../../components/Col';
import Row from '../../components/Row';
import Portlet from '../../components/Portlet';

const RegisterOldPayment = () => {
  const {register, handleSubmit} = useForm();

  const onSubmit = (data) => {
    var ax = axios.create({
      baseURL: 'http://sirim.local/api',
    });
    ax.post('old-payments', data)
      .then( res => console.log(res) )
      .catch(err => console.log(err));
  };

  return (
    <Row>
      <Col md='6'>
        <Portlet label='Registrar pago anterior'>
          <form onSubmit={handleSubmit(onSubmit)}>
            <input name="num" placeholder="Número de factura" ref={register} className="form-control"/>
            
            <input type="submit" className="btn btn-success"/>
          </form>
        </Portlet>
      </Col>
      <Col md='6'>
      </Col>
    </Row>
  );
};

if (document.getElementById('registerOldPayments')) {
  ReactDOM.render(<RegisterOldPayment />, document.getElementById('registerOldPayments'));
} 
