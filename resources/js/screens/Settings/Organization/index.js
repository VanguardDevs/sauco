import React, { useState, useEffect } from 'react';
import axios from 'axios';
// Components
import Portlet from '../../../components/Portlet';
import Loading from '../../../components/Loading';
import WidgetIcon from '../../../components/WidgetIcon';
import WidgetInfo from '../../../components/WidgetInfo';
import WidgetItem from '../../../components/WidgetItem';
import Widget from '../../../components/Widget';

const getDataDisplay = (loading, data) => {
  return (loading) ?
    <Loading 
      type={'spin'}
      height={'5%'}
      width={'5%'}
    /> : 
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
};

const Organization = () => {
  const [data, setData] = useState({});
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    axios.get('organization')
      .then( res => setData( res.data ) )
      .then( res => setLoading(false) )
      .catch( err => console.log(err) );
  }, []);

  let component = getDataDisplay(loading, data);

  return (
    <Portlet
      label='Información de la organización'
    >
      {component}
    </Portlet>
  );
};

export default Organization;
