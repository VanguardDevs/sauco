import React, { useState, useEffect } from 'react';
// Components
import Notification from '../../../components/Notification';
import Portlet from '../../../components/Portlet';
import Loading from '../../../components/Loading';

const renderComponent = (loading, data) => {
  const { id } = data;

  return (loading) ? ( 
    <Portlet>
      <Loading /> 
    </Portlet>
  ) : (
    <Portlet label='Licencias'>
      <Notification title='Licencias de actividad económica' icon='fa-book-reader' url={taxpayer+'/economic-activity-licenses'} />
    </Portlet>
  )
}

const Licenses = props => {
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    setLoading(false);
  }, [props]);
 
  let renderer = renderComponent(loading, props.taxpayer);

  return <>{renderer}</>
}

export default Licenses;

