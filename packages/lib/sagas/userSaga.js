import { put, takeLatest, all } from 'redux-saga/effects'
import { axios } from '../providers'
import { USER_FETCH_REQUESTED, fetchUserSuccess, SET_USER, UNSET_USER } from '../actions';
import CONFIG_NAMES from '../configs'

/**
 * Get currently authenticated user
 */
function* fetchUser() {
    try {
        const response = yield axios.get('/profile');

        yield localStorage.setItem(CONFIG_NAMES.USER, JSON.stringify(response.data))
        yield put(fetchUserSuccess(response.data));
    } catch (e) {
        yield put({ type: "USER_FETCH_FAILED", message: e.message });
    }
}

function* setUser(action) {
    try {
	    const { user, token } = action.payload;

        yield localStorage.setItem(CONFIG_NAMES.USER, JSON.stringify(user))
        yield localStorage.setItem(CONFIG_NAMES.AUTH_TOKEN, token)
    } catch (e) {
        yield put({ type: "USER_FETCH_FAILED", message: e.message });
    }
}

function* unsetUser() {
    console.log(CONFIG_NAMES.AUTH_TOKEN)
    try {
        yield localStorage.removeItem(CONFIG_NAMES.USER)
        yield localStorage.removeItem(CONFIG_NAMES.AUTH_TOKEN)
    } catch (e) {
        yield put({ type: "USER_FETCH_FAILED", message: e.message });
    }
}

export default function* rootSaga() {
    yield all([
        takeLatest(USER_FETCH_REQUESTED, fetchUser),
        takeLatest(SET_USER, setUser),
        takeLatest(UNSET_USER, unsetUser)
    ])
}
