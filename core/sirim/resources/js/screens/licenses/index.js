import React, { useState, useEffect, useMemo } from 'react';
import ReactDOM from 'react-dom';
import axios from 'axios';

// Components
import {
  Row,
  Loading,
  Portlet,
  PortletBody,
  Table,
  Col
} from '../../components';

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
            <PortletBody>
              <Loading />
            </PortletBody>
          </Portlet>
        ) : (
          <Portlet label="Licencias emitidas">
            <PortletBody>
              <Table columns={columns} data={data} />
            </PortletBody>
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
