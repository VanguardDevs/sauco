import React, { useState, useEffect } from 'react';
import ReactDOM from 'react-dom';
import axios from 'axios';

// Components
import Representations from './Representations';
import Actions from './Actions';
import Licenses from './Licenses';
import EconomicActivities from './EconomicActivities';
import Row from '../../../components/Row';
import Col from '../../../components/Col';

const Index = (props) => {
  const [data, setData] = useState({});
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    axios.get(`taxpayers/${props.taxpayerId}`)
      .then((res) => setData(res.data))
      .then(res => setLoading(false))
      .catch(err => console.log(err));
  }, []);

  return (
    <Row>
      {
        (loading) ? <></>
        : <>
          <Col xl={6} sm={6}>
            <Actions taxpayer={data}/>
          </Col>
          <Col xl={6} sm={6}>
            <Licenses taxpayer={taxpayer}/>
          </Col>
        </>
      }
    </Row>
  );
}

if (document.getElementById('taxpayer')) {
  const taxpayer = document.getElementById('taxpayer');

  const props = {
    taxpayerId: taxpayer.getAttribute('data_id')
  }; 
  
  ReactDOM.render(<EconomicActivities {...props} />, document.getElementById('economic-activities'));
  ReactDOM.render(<Representations {...props} />, document.getElementById('representations'));
  ReactDOM.render(<Index {...props} />, document.getElementById('row'));
}
