import { NOTIFY, CLEAR_NOTIFICATION } from './types'; 

const notificationsReducer = (state = {}, action) => {
  switch(action.type) {
    case NOTIFY:
      return action.payload;
    case CLEAR_NOTIFICATION:
      return {}
    default:
      return state;
  }
}

export { notificationsReducer }
