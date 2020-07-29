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
    axios.get(`licenses`)
      .then(res => setData(res.data))
      .then(res => setLoading(false))
      .catch(err => console.log(err));
  }, []);

  const columns = useMemo(() => [
    { header: 'Número', accessor: 'num' },
    { header: 'RIF', accessor: 'taxpayer.rif' },
    { header: 'Razón Social', accessor: 'taxpayer.name' },
    { header: 'Ordenanza', accessor: 'ordinance.description' },
    { header: 'Emitida', accessor: 'emission_date' }
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
          <Portlet label="Licencias emitidas">
            <Table columns={columns} data={data} />
          </Portlet>
        )}
      </Col>
      }
    </Row>
  );
}

if (document.getElementById('licenses')) {
  ReactDOM.render(<Index/>, document.getElementById('licenses'));
}
