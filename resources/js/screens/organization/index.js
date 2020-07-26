import React, { useState, useEffect } from 'react';
import ReactDOM from 'react-dom';
import axios from 'axios';
// Components
import Portlet from '../../components/Portlet';
import Notification from '../../components/Notification';
import Row from '../../components/Row';
import Col from '../../components/Col';
import Loading from '../../components/Loading';
import WidgetIcon from '../../components/WidgetIcon';
import WidgetInfo from '../../components/WidgetInfo';
import WidgetItem from '../../components/WidgetItem';
import Widget from '../../components/Widget';
import { Warning, ToastWrapper  } from '../../utils/toast';

const getDataDisplay = (loading, data) => (
  (loading) ? 
    <Loading 
      type={'spin'}
      height={'5%'}
      width={'5%'}
    />
  : (<>
    <Widget>
      <WidgetItem>
        <WidgetIcon
          type="icon"
          icon="fas fa-question-circle"
        />
        <WidgetInfo
          desc='Sin información.'
        />
      </WidgetItem>
    </Widget>
  </>)
);

const Organization = () => {
  const [data, setData] = useState({});
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    axios.get('organization')
      .then( res => setData( res.data ) )
      .then( res => setLoading(false) )
      .then(() => Warning('¡Este módulo se encuentra en construcción!'))
      .catch( err => console.log(err) );
  }, []);

  let component = getDataDisplay(loading, data);

  return (
    <Row>
      <Col md={6}>
        <Portlet
          label='Información de la organización'
          fluid
        >
          {component} 
          </Portlet>
      </Col>
      <Col md={6}>
        <Portlet
          label='Acciones'
        >
          <Notification url='organization/withholdings' title="Retenciones" icon='fas fa-hand-holding-usd' />   
        </Portlet>
      </Col>
      <ToastWrapper />
    </Row>
  );
};

if (document.getElementById('organization')) {
  ReactDOM.render(<Organization />, document.getElementById('organization'));
}
