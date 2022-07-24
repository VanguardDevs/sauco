import React, { useState, useEffect } from 'react';
import ReactDOM from 'react-dom';
import axios from 'axios';
// Components
import  {
  Portlet,
  PortletFooter,
  PortletHeader,
  PortletBody,
  Header,
  Row,
  Col,
  Loading,
} from '../../components';
import { isEmpty } from '../../utils';

const ShowLicense = (props) => {
  const [data, setData] = useState({});
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    axios.get(`licenses/${props.data}`)
      .then( res => setData( res.data ) )
      .then( res => setLoading(false) )
      .catch( err => console.log(err) );
  }, []);

  return (
    <Row>
      <Col xl={12}>
        <Portlet>
          { (loading) ?
            <PortletBody>
              <Loading />
            </PortletBody>
            : <>
              <PortletHeader label={`Licencia ${data.num}`} />
              <PortletBody>
                <h5>LICENCIA DE { data.ordinance.description }</h5>
                <h5>Fecha de emisión: {data.emission_date}</h5>
                <br />
                <h5>Representante: {data.representation.person.name}</h5>
                <br />
                <h5>Actividades Económicas</h5>
                {data.economic_activities.map((activity, index) => (
                  <div key={index}>
                    <span>{activity.code} - {activity.name}</span>
                  </div>
                ))}
                <br />
                <h5>Usuario: {data.user.login}</h5>
              </PortletBody>
              <PortletFooter>
                <a href={`${window.location.origin}/licenses/${data.id}/download`} class='btn btn-info' title='Imprimir licencia' target='_blank'>
                    <i class='flaticon2-download'></i>
                    Imprimir licencia
                </a>
                {'    '}
                <a href={`${window.location.origin}/taxpayers/${data.taxpayer_id}`} class='btn btn-success' title='Imprimir licencia'>
                    <i class='fas fa-eye '></i>
                    Ver perfil
                </a>
              </PortletFooter>
            </>
          }
        </Portlet>
      </Col>
    </Row>
  );
};

const element = document.getElementById('license-show');

if (element) {
  let data = element.getAttribute('data-id');
  ReactDOM.render(<ShowLicense data={data}/>, element);
}
