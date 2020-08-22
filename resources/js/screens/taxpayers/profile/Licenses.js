import React, { useState, useEffect } from 'react';
// Components
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
    <Portlet>
      <PortletHeader label='Licencias' />
      <PortletBody>
        <Notification title='Licencias de actividad económica' icon='book-reader' url={taxpayer+'/economic-activity-licenses'} />
      </PortletBody>
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

