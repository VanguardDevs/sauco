import React from 'react';
import ReactDOM from 'react-dom';

// Components
import Portlet from './Portlet';
import Representations from './Representations';
import Notification from './Notification';
import Row from './Row';
import Col from './Col';

if (document.getElementById('taxpayer')) {
  const taxpayer = document.getElementById('taxpayer');

  const props = {
    taxpayerId: taxpayer.getAttribute('data_id')
  };

  const Actions = () => (
    <Portlet label='Acciones'>
      <Notification title='Declaración jurada de ingresos' icon='fa-address-book' url={taxpayer+'/affidavits'} />
      <Notification title='Multas y sanciones' icon='fa-stop-circle' url={taxpayer+'/fines'} />
      <Notification title='Solicitudes' icon='fa-paper-plane' url={taxpayer+'/applications'} />
      <Notification title='Pagos antiguos' icon='fa-history' url={taxpayer+'/old-payments'} />
    </Portlet>
  );

  const Licenses = () => (
    <Portlet label='Licencias'>
      <Notification title='Licencias de actividad económica' icon='fa-book-reader' url={taxpayer+'/economic-activity-licenses'} />
    </Portlet>
  );
  
  ReactDOM.render(
    <Row>
      <Col xl={12} sm={6}>
        <Actions />
      </Col>
      <Col xl={12} sm={6}>
        <Licenses />
      </Col>
    </Row>,
    document.getElementById('row')
  );
  ReactDOM.render(<Representations {...props} />, document.getElementById('representations'));
}
