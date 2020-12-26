import React, { useState, useEffect, useMemo } from 'react';
import ReactDOM from 'react-dom';
import axios from 'axios';

// Components
import Row from '../../components/Row';
import Loading from '../../components/Loading';
import Portlet from '../../components/Portlet';
import Table from '../../components/Table';
import Col from '../../components/Col';

const Index = (props) => {
  const [data, setData] = useState({});
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    axios.get('companies')
      .then(res => setData(res.data))
      .then(res => setLoading(false))
      .catch(err => console.log(err));
  }, []);

  const columns = useMemo(() => [
    { header: 'RIF', accessor: 'taxpayer.rif' },
    { header: 'Nombre', accessor: 'name' },
    { header: 'Dirección', accessor: 'address' },
  ], []);

  return (
    <Row>
      {
      <Col lg={12}>
        {(loading) ? (
          <Portlet>
            <Loading />
          </Portlet>
        ) : (
          <Portlet>
            <Table columns={columns} data={data} />
          </Portlet>
        )}
      </Col>
      }
    </Row>
  );
}

if (document.getElementById('companies')) {
  ReactDOM.render(<Index/>, document.getElementById('companies'));
}
