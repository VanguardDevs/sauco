import React, { Fragment, useState, useEffect } from 'react';
import ReactDOM from 'react-dom';
import axios from 'axios';

const fineAmount = (affidavit, fine) => {
  const amount = fine.amount * affidavit.amount / 10;

  return Math.round(amount * 10) / 100;
};

const currencyFormat = amount =>
  Number((amount).toFixed(2))
    .toLocaleString();

const AffidavitFine = props => {
  const [state, setState] = useState({
    data: {},
    fine: {},
    total: 0
  });
  
  useEffect(() => {
    async function fetchData() {
      const res = await axios(`/api/affidavits/${props.affidavitId}`);
      setState({ ...state, data: res.data });
    }
    fetchData(); 
  }, [props]);

  useEffect(() => {
    if (Object.keys(state.data).length) {
      const amount = fineAmount(state.data.affidavit, state.data.fineType); 
      
      setState({
        ...state,
        total: currencyFormat(state.data.affidavit.amount + amount),
        fine: {
          concept: state.data.fineType.name,
          amount: currencyFormat(amount)
        }
      });
    }
  }, [state.data]);

  let component;

  if (Object.keys(state.data).length) {
    // Missing step: if affidavit doesn't have a recharge
    component = (
      <div className="form-group col-lg-12">
        <div className="kt-heading kt-heading--md">
          {state.fine.concept}
        </div>
        <div className="kt-heading kt-heading--md">
          <p>Monto de la multa: {state.fine.amount}</p>
          <p>Total a pagar: {state.total}</p>
        </div>
      </div>
    );
  }

  return (
    <Fragment>
      {component}
    </Fragment>
  );
}

if (document.getElementById('affidavit')) {
  const affidavit = document.getElementById('affidavit');
  
  const props = {
    affidavitId: affidavit.getAttribute('data_id')
  };

  ReactDOM.render(<AffidavitFine {...props} />, document.getElementById('paymentInfo'));
}
