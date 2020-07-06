import React, { useState, useEffect } from 'react';
import ReactDOM from 'react-dom';
import { useForm } from 'react-hook-form';
import axios from 'axios';

// Components
import Portlet from '../../../components/Portlet';
import Row from '../../../components/Row';
import Col from '../../../components/Col';

const Index = () => {
  const {register, handleSubmit} = useForm();

  const onSubmit = (data) => {
    axios.post('invoice-models', data)
      .then( res => console.log(res) )
      .catch(err => console.log(err));
  };

  return (
    <Row>
      <Col lg={12}>
        <Portlet
          label='Registrar modelo de factura'
        >
          <form onSubmit={handleSubmit(onSubmit)}>
            <div className="form-group row">
              <Col md={8}>
                <input name="name" placeholder="Nombre" ref={register} className="form-control"/>
              </Col>
              <Col md={4}>
                <input name="code" placeholder="Código" ref={register} className="form-control"/>
              </Col>
            </div>
            <div className="form-group row">
              <Col md={12}>
                <textarea name="description" placeholder="Descripción" ref={register} className="form-control"/>
              </Col>
            </div>
            <button type="submit" className="btn btn-success">
              Registrar
            </button>
          </form>

        </Portlet>
      </Col>
    </Row>
  );
}

if (document.getElementById('invoice-models')) {
  ReactDOM.render(<Index />, document.getElementById('invoice-models'));
}

