import React, { useState, useEffect, useMemo } from 'react';
import axios from 'axios';
// Components
import {
  Portlet,
  Table,
  PortletHeader,
  Loading,
  Col,
  Row,
  PortletBody
} from '../../../components';

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
    { header: 'Monto', accessor: 'formatted_amount' },
    { header: 'Estado', accessor: 'state.name' }
  ], []);

  return (
    <Row>
      <Col lg={12}>
        {(loading) ? (
          <Portlet>
            <PortletBody>
              <Loading />
            </PortletBody>
          </Portlet>
        ) : (
          <Portlet>
            <PortletHeader label="Pagos" />
            <PortletBody>
              <Table columns={columns} data={data} />
            </PortletBody>
          </Portlet>
        )}
      </Col>
    </Row>
  );
}

export default Payments;

