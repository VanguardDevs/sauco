import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import axios from 'axios';

class Index extends Component {
  constructor(props) {
    super(props);
    this.state = {
      representations: []
    }
  }

  componentDidMount() {
    const { taxpayer } = this.props;

    axios.get(`/api/taxpayers/${taxpayer}/representations`)
      .then((res) => this.setState({ representations: res.data }))
      .catch((err) => console.log(err));
  }

  render() {
    const representations = this.state.representations;
    
    let component;
    if (representations.length > 0) {
      component = representations.map((rep, index) => (
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
      <React.Fragment>
        {component}
      </React.Fragment>
    );
  }
}

if (document.getElementById('representations')) {
  const taxpayer = document.getElementById('taxpayer');
  
  const props = {
    taxpayer: taxpayer.getAttribute('data_id')
  };

  ReactDOM.render(<Index {...props} />, document.getElementById('representations'));
}
