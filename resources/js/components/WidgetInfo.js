import React, { useFragment } from 'react';

const WidgetInfo = ({ title, url, desc }) => (
  <div className="kt-widget4__info">
    {
      title ? (
        <a className="kt-widget4__username" href={url}>
          {title}
        </a>
      ) : <></>
    }
    {
      desc ? (
        <a className="kt-widget4__text">
          {desc}
        </a>
      ) : <></>
    }
  </div>
);

export default WidgetInfo;
