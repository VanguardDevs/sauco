import React, { useState, useEffect } from 'react';
import { useForm } from 'react-hook-form';
import { Success, ToastWrapper  } from '../../../utils/toast';
// Components
import Col from '../../../components/Col';
import FormGroup from '../../../components/FormGroup';

const CreateInvoiceModel = props => {
  const [data, setData] = useState({});
  const {register, handleSubmit} = useForm();

  const onSubmit = (data) => {
    axios.post('invoice-models', data)
      .then(res => setData(res.data))
      .then(() => Success(`¡Modelo ${data.name} creado!`))
      .catch(err => console.log(err));
  };

  return (
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
  );
}

export default CreateInvoiceModel;
