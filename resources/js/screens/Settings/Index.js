import React from 'react';
import ReactDOM from 'react-dom';
// Components
import Notification from '../../components/Notification';
import Portlet from '../../components/Portlet';
import Col from '../../components/Col';
import Row from '../../components/Row';
import OrganizationInformation from './OrganizationInformation';

const Index = () => {
  return (
    <Row>
      <Col xl={6} md={6} sm={6}>
        <Portlet
          label="Configuraciones básicas"
          fluid
        >
          <Notification
            url='settings/years'
            icon='fa-lightbulb'
            title='Años fiscales'
          />
          <Notification
            url='settings/accounting-accounts'
            icon='fa-tag'
            title='Cuentas contables'
          />
          <Notification
            url='settings/ordinances'
            icon='fa-file'
            title='Ordenanzas'
          />
          <Notification
            url='settings/payment-methods'
            icon='fa-money-bill'
            title='Métodos de pago'
          />
          <Notification
            url='settings/tax-units'
            icon='fa-coins'
            title='Unidades tributarias'
          />
          <Notification
            url='settings/concepts'
            icon='fa-shopping-basket'
            title='Conceptos de recaudación'
          />
        </Portlet>
      </Col>
      <Col xl={6} md={6} sm={6}>
        <Portlet
          label="Administración"
        >
          <Notification
            url='administration/permissions'
            icon='fa-user-lock'
            title='Permisos'
          />
          <Notification
            url='administration/roles'
            icon='fa-user-tag'
            title='Roles'
          />
          <Notification
            url='administration/users'
            icon='fa-user-plus'
            title='Usuarios'
          />        
        </Portlet>
        <OrganizationInformation />
      </Col>
    </Row>
  );
}

if (document.getElementById('settings-screen')) {
  ReactDOM.render(<Index />, document.getElementById('settings-screen'));
}
