import React, { useState, useEffect } from 'react';
import ReactDOM from 'react-dom';
// Components
import List from './list';
import CreateInvoiceModel from './create';
import Row from '../../../components/Row';

const Index = () => {
  return (
    <Row>
      <List/>
    </Row>
  );
}

if (document.getElementById('invoice-models')) {
  ReactDOM.render(<Index />, document.getElementById('invoice-models'));
}

