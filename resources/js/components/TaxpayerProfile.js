import React from 'react';
import ReactDOM from 'react-dom';

// Components
import Portlet from './Portlet';
import Representations from './Representations';
import Notification from './Notification';

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
    </Portlet>
  );
  
  ReactDOM.render(<Actions />, document.getElementById('actions'));

  ReactDOM.render(<Representations {...props} />, document.getElementById('representations'));
}
