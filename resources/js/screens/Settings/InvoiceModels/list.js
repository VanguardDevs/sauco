import React, { useState, useEffect, useMemo } from 'react';
import axios from 'axios';
// Components
import Portlet from '../../../components/Portlet';
import Table from '../../../components/Table';
import Loading from '../../../components/Loading';
import Col from '../../../components/Col';

const List = () => {
  const [data, setData] = useState({});
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    axios.get('invoice-models')
      .then(res => setData(res.data))
      .then(res => setLoading(false))
      .catch(err => console.log(err));
  }, []);

  const columns = useMemo(() => [
    { header: 'Código', accessor: 'code' },
    { header: 'Nombre', accessor: 'name' },
    { header: 'Descripción', accessor: 'description' }
  ], []);

  return (
    <Col lg={12}>
      <Portlet label='Modelos de facturas'>
        {(loading) ? (
          <Loading />
        ) : (
          <Table columns={columns} data={data} />
        )}
      </Portlet>
    </Col>
  );
};

export default List;
