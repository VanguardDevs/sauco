import React, { useState, useEffect } from 'react';
import axios from 'axios';
// Components
import Portlet from '../../components/Portlet';

const OrganizationInfo = () => {
  const { state, setState } = useState({});

  useEffect(() => {
    axios.get('/api/organization')
      .then( res => setState({ ...res.data }) )
      .catch( err => console.log(err) );
  }, []);

  return (
    <Portlet
      label='Información de la organización'
    />
  );
};

export default OrganizationInfo;
