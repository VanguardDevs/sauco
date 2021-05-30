import React, { useState } from 'react';

const HeaderMenu = ({ children }) => (
  <div className="kt-header-menu kt-header-menu-mobile kt-header-menu--layout-default">
    <ul className="kt-menu__nav">
      {children}
    </ul>
  </div>
);

export default HeaderMenu;
