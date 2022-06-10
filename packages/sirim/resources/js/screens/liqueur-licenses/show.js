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

const ShowLiqueurLicense = (props) => {
  const [data, setData] = useState({});
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    axios.get(`licenses/${props.data}`)
      .then( res => setData( res.data ) )
      .then( res => setLoading(false) )
      .catch( err => console.log(err) );
  }, []);

  return (
    <Row>
      <Col xl={12}>
        <Portlet>
          <h5>Algo</h5>
        </Portlet>
      </Col>
    </Row>
  );
};

const element = document.getElementById('liqueur-license-show');

if (element) {
  let data = element.getAttribute('data-id');
  ReactDOM.render(<ShowLiqueurLicense data={data}/>, element);
}
