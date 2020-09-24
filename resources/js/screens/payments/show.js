import React, { useState, useEffect } from 'react';
import ReactDOM from 'react-dom';
import axios from 'axios';
// Components
import  {
  Portlet,
  PortletFooter,
  PortletHeader,
  PortletBody,
  Header,
  Row,
  Col,
  Loading,
} from '../../components';
import { isEmpty } from '../../utils'; 

const ShowNullFine = (props) => {
  const [data, setData] = useState({});
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    axios.get(`cancelled-payments/${props.data}`)
      .then( res => setData( res.data ) )
      .then( res => setLoading(false) )
      .catch( err => console.log(err) );
  }, []);

  return (
    <Row>
      <Col xl={12}>
        <Portlet>
          { (loading) ?
            <PortletBody>
              <Loading />
            </PortletBody>
            : <>
              <PortletHeader label={`Pago anulado`} />
              <PortletBody>
                <h5>Razón de anulación:</h5>
                <p>{data.reason}</p>
                <br />
                <h5>Fecha de anulación: {data.created_at}</h5>
                <h5>Usuario: {data.user.login}</h5>
                { (data.payment.state_id == 2) && (<>
                    <br />
                    <h3>Información del pago</h3>
                    <h5>Número: {data.payment.num}</h5>
                    <h5>Monto: {data.payment.formatted_amount}</h5>
                    <h5>Fecha de procesamiento: {data.payment.processed_at}</h5>
                  </>) 
                }
              </PortletBody>
            </>
          }
        </Portlet>
      </Col>
    </Row>
  );
};

const element = document.getElementById('null-payment');

if (element) {
  let data = element.getAttribute('data-id'); 
  ReactDOM.render(<ShowNullFine data={data}/>, element);
}
