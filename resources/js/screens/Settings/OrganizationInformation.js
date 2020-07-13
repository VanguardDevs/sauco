import React, { useState, useEffect } from 'react';
import axios from 'axios';
// Components
import Portlet from '../../components/Portlet';
import Loading from '../../components/Loading';

const getDataDisplay = (loading, data) => {
  return (loading) ?
    <Loading 
      type={'spin'}
      height={'5%'}
      width={'5%'}
    /> : 
    <div>Component loaded</div>
};

const OrganizationInfo = () => {
  const [data, setData] = useState({});
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    axios.get('/api/organization')
      .then( res => setData( res.data ) )
      .then( res => setLoading(false) )
      .catch( err => console.log(err) );
  }, []);

  let component = getDataDisplay(loading, data);

  return (
    <Portlet
      label='Información de la organización' >
      {component}
    </Portlet>
  );
};

export default OrganizationInfo;
