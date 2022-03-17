import { UNSET_DIALOG, SET_DIALOG } from '../actions';

const initialState = {
    status: false,
    name: ''
}

const dialogReducer = (
    previousState = initialState,
    action
) => {
    switch (action.type) {
        case SET_DIALOG:
            return {
                status: !previousState.status,
                name: action.payload
            }
        case UNSET_DIALOG:
            return initialState;
        default:
            return previousState;
    }
}

export default dialogReducer;

