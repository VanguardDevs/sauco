import React, { Fragment, useState, useEffect } from 'react';
import axios from 'axios';
// Components
import Loading from '../../../components/Loading';
import WidgetItem from '../../../components/WidgetItem';
import WidgetIcon from '../../../components/WidgetIcon';
import WidgetInfo from '../../../components/WidgetInfo';

const renderChildComponent = (loading, data) => {
  return (!loading) ?
    (data.length > 0) ?
      data.map((activity, index) => (
        <WidgetItem key={index}>
          <WidgetIcon
            type='icon'
            icon='flaticon2-percentage' 
          />

          <WidgetInfo
            title={activity.code}
            desc={activity.name}
            url={`economic-activities/${activity.id}`}
          />
        </WidgetItem>
      ))
    :
      <WidgetItem>
        <WidgetIcon
          type="icon"
          icon="fas fa-question-circle"
        />
        <WidgetInfo
          desc='No tiene actividades económicas asignadas'
        />
      </WidgetItem>
    :
    <Loading />
}

const EconomicActivities = props => {
  const [data, setData] = useState({});
  const [loading, setLoading] = useState(true);
  
  useEffect(() => {
    axios.get(`taxpayers/${props.taxpayerId}/economic-activities`)
      .then((res) => setData( res.data ))
      .then((res) => setLoading(false))
      .catch((err) => console.log(err));
  }, [props]);

  let renderer = renderChildComponent(loading, data);

  return (
    <Fragment>
     {renderer}
    </Fragment>
  );
}

export default EconomicActivities;
