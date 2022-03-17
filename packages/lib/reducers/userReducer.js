import { UNSET_USER, SET_USER, USER_FETCH_SUCCEEDED } from '../actions';

const initialState = {
    isAuth: false,
    token: '',
    exp: '',
    user: {},
    refreshToken: '',
    loading: false
}

const userReducer = (
    previousState = initialState,
    action
) => {
    switch (action.type) {
        case SET_USER:
            return {
                ...previousState,
		        ...action.payload,
                isAuth: true
            }
        case USER_FETCH_SUCCEEDED:
            return {
                ...previousState,
                user: action.payload,
                isAuth: true
            }
        case UNSET_USER:
            return initialState;
        default:
            return previousState;
    }
}

export default userReducer;

