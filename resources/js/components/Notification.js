import React from 'react';

const Notification = ({ url, title, icon, onClick}) => {

  const handleClick = () => onClick(); 

  return (
    <div className="kt-notification" onClick={handleClick}>
      <a className="kt-notification__item" href={url}>
        <div className="kt-notification__item-icon">
          <i className={`fas fa-${icon}`}></i>
        </div>
        <div className="kt-notification__item-details">
          <div className="kt-notification__item-title">
            {title} 
          </div>
        </div>
      </a>
    </div>
  )
};

export default Notification;
