import React, { useState, useEffect } from 'react';
import ReactDOM from 'react-dom';
import { useForm } from 'react-hook-form';
import { Success, ToastWrapper  } from '../../../utils/toast';

// Components
import List from './list';
import CreateInvoiceModel from './create';
import Row from '../../../components/Row';

const Index = () => {
  const [data, setData] = useState({});
  const {register, handleSubmit} = useForm();

  const onSubmit = (data) => {
    axios.post('invoice-models', data)
      .then(res => setData(res.data))
      .then(() => Success(`¡Modelo ${data.name} creado!`))
      .catch(err => console.log(err));
  };

  return (
    <Row>
      <List/>
    </Row>
  );
}

if (document.getElementById('invoice-models')) {
  ReactDOM.render(<Index />, document.getElementById('invoice-models'));
}

