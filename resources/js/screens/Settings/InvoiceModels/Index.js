import React, { useState, useEffect } from 'react';
import ReactDOM from 'react-dom';
import { useForm } from 'react-hook-form';
import { Toast, ToastWrapper  } from '../../../utils/toast';

// Components
import Portlet from '../../../components/Portlet';
import FormGroup from '../../../components/FormGroup';
import Row from '../../../components/Row';
import Col from '../../../components/Col';

const Index = () => {
  const [data, setData] = useState({});
  const {register, handleSubmit} = useForm();

  const onSubmit = (data) => {
    axios.post('invoice-models', data)
      .then(res => setData(res.data))
      .then(() => Toast(`¡Modelo ${data.name} creado!`))
      .catch(err => console.log(err));
  };

  return (
    <Row>
      <Col lg={12}>
        <Portlet
          label='Registrar modelo de factura'
        >
          <form onSubmit={handleSubmit(onSubmit)}>
            <FormGroup>
              <Col md={8}>
                <input name="name" placeholder="Nombre" ref={register} className="form-control"/>
              </Col>
              <Col md={4}>
                <input name="code" placeholder="Código" ref={register} className="form-control"/>
              </Col>
            </FormGroup>
            <FormGroup>
              <Col md={12}>
                <textarea name="description" placeholder="Descripción" ref={register} className="form-control"/>
              </Col>
            </FormGroup>
            <button type="submit" className="btn btn-success">
              Registrar
            </button>
          </form>
          <ToastWrapper />
        </Portlet>
      </Col>
    </Row>
  );
}

if (document.getElementById('invoice-models')) {
  ReactDOM.render(<Index />, document.getElementById('invoice-models'));
}

