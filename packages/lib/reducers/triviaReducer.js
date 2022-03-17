import { UNSET_TRIVIA, SET_TRIVIA, SET_SUBTHEMES, UNSET_SUBTHEMES } from '../actions';

const initialState = {
    selected: false,
    trivia: {},
    selectedSubthemes: []
}

const dialogReducer = (
    state = initialState,
    action
) => {
    switch (action.type) {
        case SET_TRIVIA:
            return {
                ...state,
                selected: true,
                trivia: action.payload,
            }
        case SET_SUBTHEMES: {
            return {
                ...state,
                selectedSubthemes: [...state.selectedSubthemes, action.payload]
            }
        }
        case UNSET_SUBTHEMES: {
            return {
                ...state,
                selectedSubthemes: state.selectedSubthemes.filter(id => id != action.payload)
            }
        }
        case UNSET_TRIVIA:
            return initialState;
        default:
            return state;
    }
}

export default dialogReducer;

