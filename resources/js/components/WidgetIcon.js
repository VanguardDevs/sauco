import React from 'react';
import PropTypes from 'prop-types';

const getClasses = (type) => (
  (type == 'image') ? 'kt-widget4__pic kt-widget4__pic--pic'
  : 'kt-widget4__icon'
);

const getIcon = (type, icon) => (
  (type == 'image') ?  <img src={icon} alt="" />
  : <i className={icon} />
);

const WidgetIcon = ({ type, icon }) => {
  const classes = getClasses(type);
  const pic = getIcon(type, icon);

  return (
    <div className={classes}>
      {pic}  
    </div>
  );
};

WidgetIcon.defaultProps = {
  type: 'icon'
};

export default WidgetIcon;
          
