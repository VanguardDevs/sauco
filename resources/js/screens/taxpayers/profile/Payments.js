import React, { useState, useEffect, useMemo } from 'react';
import axios from 'axios';
// Components
import Portlet from '../../../components/Portlet';
import Table from '../../../components/Table';
import Loading from '../../../components/Loading';
import Col from '../../../components/Col';
import Row from '../../../components/Row';

const Payments = (props) => {
  const [data, setData] = useState({});
  const [loading, setLoading] = useState(true);

   useEffect(() => {
    axios.get(`taxpayers/${props.taxpayer}/payments`)
      .then(res => setData(res.data))
      .then(res => setLoading(false))
      .catch(err => console.log(err));
  }, []);

  const columns = useMemo(() => [
    { header: 'Número', accessor: 'num' },
    { header: 'Monto', accessor: 'amount' },
    { header: 'Estado', accessor: 'state.name' }
  ], []);

  return (
    <Row>
      <Col lg={12}>
        {(loading) ? (
          <Portlet>
            <Loading />
          </Portlet>
        ) : (
          <Portlet label="Pagos">
            <Table columns={columns} data={data} />
          </Portlet>
        )}
      </Col>
    </Row>
  );
}

export default Payments;

