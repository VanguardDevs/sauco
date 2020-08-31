import React, { useState, useEffect } from 'react';
import ReactDOM from 'react-dom';
import axios from 'axios';
import dateformat from '../utils/dateformat';
import isEmpty from '../utils/isEmpty';

// Components
import Col from './Col';
import Loading from './Loading';

const getFineData = ( settlementAmount, concepts ) => {
  let data = {
    'amount': null,
    'message': 'El pago recibirá una multa equivalente al 30% de la liquidación'
  };
  let amount = concepts[0].amount * settlementAmount / 10;

  if (concepts.length > 1) {
    data.message = 'El pago recibirá una multa equivalente al 60% de la liquidación';
    amount = amount * 2;
  }
  data.amount = Math.round(amount * 10) / 100;

  return data;
};

const currencyFormat = amount => (
  new Intl.NumberFormat('es-VE')
    .format(amount)
);

const hasProcessedPayment = payment => {
  if (!isEmpty(payment)) {
    return (payment.state_id == 2) ? true : false; 
  }
};

const AffidavitFine = props => {
  const [data, setData] = useState({});
  const [loading, setLoading] = useState(true);
  const [fine, setFine] = useState({});
  const [total, setTotal] = useState(0);
  
  useEffect(() => {
    axios.get(`affidavits/${props.affidavitId}`)
      .then(res => {
        let total = res.data.affidavit.amount;

        if (res.data.fine.apply && hasProcessedPayment(res.data.affidavit.payment)) {
          let fineData = getFineData(total, res.data.fine.concepts);
          total += fineData.amount;
          setFine(fineData);
        } else {
          setFine({ hasPayment: true });
        }

        setData(res.data);
        setTotal(total);
      })
      .then(res => setLoading(!loading))
      .catch(err => console.log(err));
  }, [props]);

  return (
    <Col lg='12'>
      { (!loading) 
        ? (
          <>
            <div className="kt-heading kt-heading--md">
              { 
              (!fine.hasPayment) && 
                <div className="kt-heading kt-heading--md">
                  <p>{fine.message} : {currencyFormat(fine.amount)}</p>
                </div>
              }
            </div>
            <div className="kt-heading kt-heading--md">
              <p>Total: {currencyFormat(total)}</p>
              <h5>Fecha: {dateformat(data.affidavit.processed_at)}</h5>
              <h5>Por: {data.affidavit.user.full_name}</h5>
            </div>
          </>
        ) : <Loading />
      }
    </Col>
  );
}

if (document.getElementById('affidavit')) {
  const affidavit = document.getElementById('affidavit');
  
  const props = {
    affidavitId: affidavit.getAttribute('data_id')
  };

  ReactDOM.render(<AffidavitFine {...props} />, document.getElementById('paymentInfo'));
}
