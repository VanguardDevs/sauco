import React, { useState, useEffect } from 'react';
import Select from 'react-select'; 
import axios from 'axios';
import { useForm, Controller } from 'react-hook-form';
import { Success, Error, ToastWrapper  } from '../../../utils/toast';
// Components
import {
  Portlet,
  PortletHeader,
  PortletBody,
  Col,
  Notification,
  Loading
} from '../../../components';

const getMapOfMonths = (months) => months.map(month => {
  return {
    value: month.id,
    label: month.name
  }
});

const create = (props) => {
  const { taxpayer, user } = props;
  const [data, setData] = useState({});
  const [months, setMonths] = useState([]);
  const [disable, setDisable] = useState(false);
  const [loading, setLoading] = useState(true);
  const {control, register, handleSubmit} = useForm();

  useEffect(() => {
    axios.get('withholdings-months')
      .then((res) => setMonths( getMapOfMonths(res.data) ))
      .then((res) => setLoading(false))
      .catch((err) => console.log(err));
  }, [props]);

  const onSubmit = (data) => {
    setDisable(true);
    axios.post(`taxpayers/${taxpayer}/withholdings`, {
      ...data, user: user
    })
      .then(res => {
        const data = res.data;
        setDisable(false); 
        // Notify
        (data.success) ? Success(data.message) : Error(data.message);
      })
      .catch(err => console.log(err));
  };

  return (!loading) ?
    <Portlet fluid>
      <PortletHeader label='Realizar retención' sublabel='Ingrese el monto y seleccione el mes de la declaración.' />
      <PortletBody>
        <form onSubmit={handleSubmit(onSubmit)}>
          <div className='form-group row'>
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
              <button type="submit" className="btn btn-success" disabled={disable}>
                Guardar
              </button>
            </Col>
          </div>
        </form>
      </PortletBody>
      <ToastWrapper />
    </Portlet>
  : 
  <Portlet>
    <PortletBody>
      <Loading />
    </PortletBody>
  </Portlet>
}

export default create;
