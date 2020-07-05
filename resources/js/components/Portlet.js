import React from 'react';

const Portlet = ({ label, children}) => (
  <div className="kt-portlet kt-portlet--height-fluid">
    <div className="kt-portlet__head">
      <div className="kt-portlet__head-label">
        <h3 className="kt-portlet__head-title">{label}</h3>
      </div>
    </div>
    <div className="kt-portlet__body">
      {children}
    </div>
  </div>
);

export default Portlet;
