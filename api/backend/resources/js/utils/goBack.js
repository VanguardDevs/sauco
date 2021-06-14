import history from './history';

export default (event) => {
  event.preventDefault();
  history.goBack();
};
