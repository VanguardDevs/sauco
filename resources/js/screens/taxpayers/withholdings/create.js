import React, { useState, useEffect } from 'react';
import Select from 'react-select'; 
import axios from 'axios';
import { useForm, Controller } from 'react-hook-form';
import { Toast, ToastWrapper  } from '../../../utils/toast';
// Components
import Portlet from '../../../components/Portlet';
import FormGroup from '../../../components/FormGroup';
import Col from '../../../components/Col';
import Notification from '../../../components/Notification';
import Loading from '../../../components/Loading';

const getMapOfMonths = (months) => months.map(month => {
  return {
    value: month.id,
    label: month.name
  }
});

const create = (props) => {
  const [data, setData] = useState({});
  const [months, setMonths] = useState([]);
  const [loading, setLoading] = useState(true);
  const {control, register, handleSubmit} = useForm();

  useEffect(() => {
    axios.get('withholdings-months')
      .then((res) => setMonths( getMapOfMonths(res.data) ))
      .then((res) => setLoading(false))
      .catch((err) => console.log(err));
  }, [props]);

  const onSubmit = (data) => {
    axios.post(`taxpayers/${props.taxpayer}/withholdings`, data)
      .then(res => setData(res.data))
      .then(() => Toast(`¡Retención creada!`))
      .catch(err => console.log(err));
  };

  return (!loading) ?
    <Portlet 
      label='Realizar retención'
      sublabel='Ingrese el monto y seleccione el mes de la declaración.'
      fluid
    >
      <form onSubmit={handleSubmit(onSubmit)}>
        <FormGroup>
          <Col lg={5} md={5}>
            <Controller
              as={Select}
              name="month"
              options={months}
              control={control}
              placeholder='Seleccione'
              inputRef={register}
            /> 
          </Col>
          <Col lg={5} md={5}>
            <input name="amount" placeholder="Monto" ref={register} className="form-control decimal-input-mask"/>
          </Col>
          <Col md={2}>
            <button type="submit" className="btn btn-success">
              Guardar
            </button>
          </Col>
        </FormGroup>
      </form>
      <ToastWrapper />
    </Portlet>
  : 
  <Portlet>
    <Loading />
  </Portlet>
}

export default create;
