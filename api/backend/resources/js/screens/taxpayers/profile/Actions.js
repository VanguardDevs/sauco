import React, { useState, useEffect } from 'react';
import Loading from '../../../components/Loading';
import Portlet from '../../../components/Portlet';
import Notification from '../../../components/Notification';

const renderComponent = (loading, data) => {
  const { id } = data;

  return (loading) ? ( 
    <Portlet>
      <Loading /> 
    </Portlet>
  ) : (
    <Portlet
      label='Acciones'
      fluid
    >
      <Notification title='Multas y sanciones' icon='fa-stop-circle' url={id+'/fines'} />
      <Notification title='Solicitudes' icon='fa-paper-plane' url={id+'/applications'} /> 
      <Notification title='Declaración jurada de ingresos' icon='fa-address-book' url={id+'/affidavits'} />
      <Notification title='Retenciones' icon='fa-hand-holding-usd' url={id+'/deductions'} />
    </Portlet>
  ) 
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
