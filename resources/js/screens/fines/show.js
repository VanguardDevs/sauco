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
    axios.get(`cancelled-fines/${props.data}`)
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
              <PortletHeader label={`Multa anulada # ${data.id}`} />
              <PortletBody>
                <h5>Usuario: {data.user.login}</h5>
              </PortletBody>
            </>
          }
        </Portlet>
      </Col>
    </Row>
  );
};

const element = document.getElementById('null-fine');

if (element) {
  let data = element.getAttribute('data-id'); 
  ReactDOM.render(<ShowNullFine data={data}/>, element);
}
