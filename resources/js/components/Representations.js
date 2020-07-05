import React, { Fragment, useState, useEffect } from 'react';
import axios from 'axios';

const Representations = props => {
  const [state, setState] = useState({
    taxpayer: props.taxpayerId,
    representations: {}
  });
  
  useEffect(() => {
    axios.get(`/api/taxpayers/${state.taxpayer}/representations`)
      .then((res) => setState({ ...state, representations: res.data }))
      .catch((err) => console.log(err));
  }, [props]);

  let component;
  if (state.representations.length > 0) {
    component = state.representations.map((rep, index) => (
      <div className="kt-widget4__item" key={index}>
        <div className="kt-widget4__pic kt-widget4__pic--pic">
          <img src="/assets/images/user-default.png" alt="" />
        </div>

        <div className="kt-widget4__info">
          <a className="kt-widget4__username">
            {rep.person.name}
          </a>
          <p className="kt-widget4__text">
            {rep.representation_type.name}
          </p>
        </div>
      </div>
    ));
  } else {
    component = <p>Este contribuyente no tiene representante</p>
  }

  return (
    <Fragment>
      {component}
    </Fragment>
  );
}

export default Representations;
