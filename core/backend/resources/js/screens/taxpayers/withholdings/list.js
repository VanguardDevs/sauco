import React, { useState, useEffect } from 'react';
import axios from 'axios';
// Components
import Portlet from '../../../components/Portlet';
import Loading from '../../../components/Loading';

const List = (props) => {
  const [data, setData] = useState({});
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    axios.get(`taxpayer/${props.taxpayer}/deductions`)
      .then(res => setData(res.data))
      .then(res => setLoading(false))
      .catch(err => console.log(err))
  }, []);

  return <Portlet><Loading /></Portlet>;
};

export default List;

