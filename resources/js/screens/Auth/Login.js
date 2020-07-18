import React from 'react';
import ReactDOM from 'react-dom';
import axios from 'axios';
import { Toast, ToastWrapper  } from '../../utils/toast';
import FormGroup from '../../components/FormGroup';
import { useForm, Controller } from 'react-hook-form';

const Login = () => {
  const {control, register, handleSubmit} = useForm();

  const onSubmit = (data) => {
    axios.post(`login`, data)
      .then(res => Toast(`${res.data.message}`))
      .catch(err => console.log(err));
  };

  return (
    <div className="kt-login__form">
      <div className="kt-login__title">
         <h3>Inicio de Sesión</h3>
      </div>
      <form className="kt-form" onSubmit={handleSubmit(onSubmit)}>
        <FormGroup>
          <input type="text" name="login" className="form-control" autoFocus placeholder="Usuario" ref={register} required/>
        </FormGroup>
        <FormGroup>
          <input type="password" className="form-control" name="password" required placeholder="Contraseña" ref={register} />
        </FormGroup>
        <div className="kt-login__actions">
          <button type="submit" id="kt_login_signin_submit" className="btn btn-primary btn-elevate kt-login__btn-primary">
              Acceder
          </button>
        </div>
      </form>
      <ToastWrapper />
    </div>
  );
}

if (document.getElementById('login')) {
  ReactDOM.render(<Login />, document.getElementById('login'));
}
