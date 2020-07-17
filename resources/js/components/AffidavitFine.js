import React, { useState, useEffect } from 'react';
import ReactDOM from 'react-dom';
import axios from 'axios';
import dateformat from '../utils/dateformat';
// Components
import Col from './Col';
import Loading from './Loading';

const fineAmount = (affidavit, fine) => {
  const amount = fine.amount * affidavit.amount / 10;

  return Math.round(amount * 10) / 100;
};

const getFineData = ({ affidavit, fine }) => ({
  concept: fine.data.name,
  amount: fineAmount(affidavit, fine.data)
});

const currencyFormat = amount =>
  Number((amount).toFixed(2))
    .toLocaleString();

const AffidavitFine = props => {
  const [data, setData] = useState({});
  const [loading, setLoading] = useState(true);
  const [fine, setFine] = useState({});
  const [total, setTotal] = useState(0);
  
  useEffect(() => {
    axios.get(`affidavits/${props.affidavitId}`)
      .then(res => {
        let total = res.data.affidavit.amount;

        if (res.data.fine.apply) {
          let fineData = getFineData(res.data);
          total += fineData.amount;
          setFine(getFineData(res.data));
        }

        setData(res.data);
        setTotal(total);
      })
      .then(res => setLoading(!loading))
      .catch(err => console.log(err));
  }, [props]);

  let component;

  if (!loading) {
    component = (
      <>
        <div className="kt-heading kt-heading--md">
        </div>
        {
          (data.fine.apply) ? 
            <div className="kt-heading kt-heading--md">
              <p>
                {fine.concept}
                : {currencyFormat(fine.amount)}
              </p>
            </div>
          : <></>
        }
        <div className="kt-heading kt-heading--md">
          <p>Total a pagar: {currencyFormat(total)}</p>
          <h5>Recibida {dateformat(data.affidavit.processed_at)}</h5>
        </div>
      </>
    );
  } else {
    component = <Loading />
  }

  return (
    <Col lg='12'>
      {component}
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
