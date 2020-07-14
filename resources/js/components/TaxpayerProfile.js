import React, { useState, useEffect } from 'react';
import ReactDOM from 'react-dom';
import axios from 'axios';

// Components
import Portlet from './Portlet';
import Representations from './Representations';
import EconomicActivities from './EconomicActivities';
import Notification from './Notification';
import Row from './Row';
import Col from './Col';

const Profile = (props) => {
  const {
    taxpayerId: taxpayer
  } = props;

  const [data, setData] = useState({});
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    axios.get(`taxpayers/${taxpayer}`)
      .then((res) => setData(res.data))
      .then(res => setLoading(false))
      .catch(err => console.log(err));
  }, []);

  const Actions = (type) => {
    return (
      <Portlet
        label='Acciones'
        fluid
      >
        <Notification title='Multas y sanciones' icon='fa-stop-circle' url={taxpayer+'/fines'} />
        <Notification title='Solicitudes' icon='fa-paper-plane' url={taxpayer+'/applications'} /> 
        {
          (type != 'JURÍDICO') ? <> 
            <Notification title='Declaración jurada de ingresos' icon='fa-address-book' url={taxpayer+'/affidavits'} />
            <Notification title='Retenciones' icon='fa-hand-holding-usd' url={taxpayer+'/withholdings'} />
          </>: <></>
        }
      </Portlet>
    );
  }

  const Licenses = () => (
    <Portlet label='Licencias'>
      <Notification title='Licencias de actividad económica' icon='fa-book-reader' url={taxpayer+'/economic-activity-licenses'} />
    </Portlet>
  );

  return (
    <Row>
      {
        (loading) ? <></>
        : <>
          <Col xl={6} sm={6}>
            <Actions type={data.taxpayer_type.description}/>
          </Col>
          <Col xl={6} sm={6}>
            <Licenses />
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
  ReactDOM.render(<Profile {...props} />,document.getElementById('row'));
  ReactDOM.render(<Representations {...props} />, document.getElementById('representations'));
}
