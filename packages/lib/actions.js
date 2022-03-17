export const UNSET_DIALOG = 'UNSET_DIALOG';
export const SET_DIALOG = 'SET_DIALOG';
export const UNSET_TRIVIA = 'UNSET_TRIVIA';
export const SET_TRIVIA = 'SET_TRIVIA';
export const UNSET_USER = 'UNSET_USER';
export const SET_USER = 'SET_USER'
export const USER_FETCH_REQUESTED = 'USER_FETCH_REQUESTED'
export const USER_FETCH_SUCCEEDED = 'USER_FETCH_SUCCEEDED'
export const USER_FETCH_FAILED = 'USER_FETCH_FAILED'
export const SET_SUBTHEMES = 'SET_SUBTHEMES';
export const UNSET_SUBTHEMES = 'UNSET_SUBTHEMES';

export const unsetSubtheme = data => ({
    type: UNSET_SUBTHEMES,
    payload: data
});

export const setSubtheme = data => ({
    type: SET_SUBTHEMES,
    payload: data
});

export const unsetTrivia = () => ({
    type: UNSET_TRIVIA
});

export const setTrivia = data => ({
    type: SET_TRIVIA,
    payload: data
});

export const unsetUser = () => ({
    type: UNSET_USER
});

export const setUser = data => ({
    type: SET_USER,
    payload: data
});

export const unsetDialog = (name) => ({
    type: UNSET_DIALOG,
    payload: name
});

export const setDialog = (name) => ({
    type: SET_DIALOG,
    payload: name
});

export const fetchUser = () => ({
    type: USER_FETCH_REQUESTED
});

export const fetchUserSuccess = data => ({
    type: USER_FETCH_SUCCEEDED,
    payload: data
});
