import React, { useState, useEffect } from 'react';
import ReactDOM from 'react-dom'; 

const AccountingAccounts = () => {
  return (
    <div className="kt-portlet">
      <div className="kt-portlet__head">
        <div className="kt-portlet__head-label">
          <h3 className="kt-portlet__head-title">
            Control de Cuentas Contables
          </h3>
        </div>
        <div className="kt-portlet__head-toolbar">
          <div className="kt-portlet__head-actions">
            <a href="accounting-accounts/create" className="btn btn-clean btn-sm btn-icon btn-icon-md" title="Nuevo concepto de recaudación">
                <i className="fas fa-plus"></i>
            </a>
          </div>
        </div>
      </div>
      <div className="kt-portlet__body">
      <table id="tConcepts" className="table table-bordered table-striped datatables">
        <thead>
          <tr>
            <th width="50%">Nombre</th>
            <th width="15%">Ordenanza</th>
            <th width="15%">Método</th>
            <th width="10%">Monto</th>
            <th width="10%">Acciones</th>
          </tr>
        </thead>
      </table>
    </div>
  </div>
  ); 
}

if (document.getElementById('accountingAccounts')) {
  ReactDOM.render(<AccountingAccounts />, document.getElementById('accountingAccounts'));
}

