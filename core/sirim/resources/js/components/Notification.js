import React from 'react';

const Notification = ({ url, title, icon}) => (
  <div className="kt-notification">
    <a className="kt-notification__item" href={url}>
      <div className="kt-notification__item-icon">
        <i className={`fas ${icon}`}></i>
      </div>
      <div className="kt-notification__item-details">
        <div className="kt-notification__item-title">
          {title} 
        </div>
      </div>
    </a>
  </div>
);

export default Notification;
