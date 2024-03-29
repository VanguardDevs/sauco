import React from 'react';
import ReactDOM from 'react-dom';
// Components
import Notification from '../../components/Notification';
import Portlet from '../../components/Portlet';
import Col from '../../components/Col';
import Row from '../../components/Row';

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
          <Notification
            url='settings/invoice-models'
            icon='fa-receipt'
            title='Modelos de factura'
          />
        </Portlet>
      </Col>
      <Col xl={6} md={6} sm={6}>
        <Portlet
          label="Administración de usuarios"
        >
          <Notification
            url='settings/administration/permissions'
            icon='fa-user-lock'
            title='Permisos'
          />
          <Notification
            url='settings/administration/roles'
            icon='fa-user-tag'
            title='Roles'
          />
          <Notification
            url='settings/administration/users'
            icon='fa-user-plus'
            title='Usuarios'
          />        
        </Portlet>
      </Col>
    </Row>
  );
}

if (document.getElementById('settings-screen')) {
  ReactDOM.render(<Index />, document.getElementById('settings-screen'));
}
