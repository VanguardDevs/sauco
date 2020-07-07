import React, { useState, useEffect } from 'react';
import axios from 'axios';
// Components
import Portlet from '../../components/Portlet';

const getInnerChild = (state) => (
  (state) ? {
    <p>La información de la institución no ha sido cargada</p>
  } : {
    {state}
  }
);

const OrganizationInfo = () => {
  const { state, setState } = useState({});

  useEffect(() => {
    axios.get('/api/organization')
      .then( res => setState({ ...res.data }) )
      .catch( err => console.log(err) );
  }, []);

  let children = getInnerChild(state); 

  return (
    <Portlet
      label='Información de la organización'
    >
      {chidlren}
    </Portlet>
  );
};

export default OrganizationInfo;
