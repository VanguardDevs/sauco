import React, { useState, useEffect, Fragment } from 'react';
import ReactDOM from 'react-dom'; 

// Component
import Meta from './Meta';

const RegisterAccountingAccounts = () => {
  return (
    <Fragment>
      <Meta
        title='Nueva cuenta contable'
      />

      <div className="kt-portlet">
        <div className="kt-portlet__body">
          <div className="form-group row">
            <div className="col-lg-12">
              <label>Nombre <span className="text-danger">*</span></label>
            </div>
          </div>

          <div className="kt-portlet__foot">
            <div className="kt-form__actions">
              <div className="row">
                <div className="col-lg-12">
                  <a href="{{ url('geographic-area/communities') }}" className="btn btn-secondary" id="cancel"><i className="fas fa-reply"></i> Regresar</a>

                  <button type="submit" className="btn btn-primary" id="send">
                    <i className="flaticon-refresh"></i>
                    Actualizar
                  </button>
                  <button type="submit" className="btn btn-primary" id="send">
                    <i className="fas fa-save"></i>
                    Registrar
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </Fragment>
  ); 
}

if (document.getElementById('registerAccountingAccounts')) {
  ReactDOM.render(<RegisterAccountingAccounts />, document.getElementById('registerAccountingAccounts'));
}

