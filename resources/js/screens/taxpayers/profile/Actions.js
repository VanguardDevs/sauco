import React, { useState, useEffect } from 'react';
import {
  Loading,
  Portlet,
  PortletBody,
  PortletHeader,
  Notification
} from '../../../components';

const renderComponent = (loading, data) => {
  const { id } = data;

  return (loading) ? ( 
    <Portlet>
      <PortletBody>
        <Loading /> 
      </PortletBody>
    </Portlet>
  ) : (
    <Portlet fluid>
      <PortletHeader label='Acciones' />
      
      <PortletBody>
        <Notification title='Multas y sanciones' icon='stop-circle' url={id+'/fines'} />
        <Notification title='Solicitudes' icon='paper-plane' url={id+'/applications'} /> 
        <Notification title='Declaración jurada de ingresos' icon='address-book' url={id+'/affidavits'} />
        <Notification title='Retenciones' icon='hand-holding-usd' url={id+'/withholdings'} />
      </PortletBody>
    </Portlet>
  ); 
}

const Actions = props => {
  const [loading, setLoading] = useState(true);
  useEffect(() => {
    setLoading(false);
  }, [props]);
 
  let renderer = renderComponent(loading, props.taxpayer);

  return <>{renderer}</>
}

export default Actions;
