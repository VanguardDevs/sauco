import * as React from 'react'
import CONFIG_NAMES from '../configs'

const AuthContext = React.createContext()

const initialState = {
    isAuth: false,
    user: {},
    token: ''
}

const getInitialState = () => {
    const localInitialState = { ...initialState };

    if (localStorage.getItem(CONFIG_NAMES.USER)) {
        localInitialState.user = JSON.parse(localStorage.getItem(CONFIG_NAMES.USER))
    }
    if (localStorage.getItem(CONFIG_NAMES.AUTH_TOKEN)) {
        localInitialState.token = localStorage.getItem(CONFIG_NAMES.AUTH_TOKEN);
        localInitialState.isAuth = true;
    }

    return localInitialState;
}

function authReducer(state, action) {
    if (action) {
        switch (action.type) {
            case 'LOGIN': {
                return {
                    ...state,
                    user: action.payload.user,
                    token: action.payload.token,
                    isAuth: true
                }
            }
            case 'LOGOUT': {
                return initialState
            }
            default: {
                throw new Error(`Unhandled action type: ${action.type}`)
            }
        }
    }
}

function AuthProvider({ children }) {
    const [state, dispatch] = React.useReducer(authReducer, getInitialState())

    return (
        <AuthContext.Provider value={{ state, dispatch }}>
            {children}
        </AuthContext.Provider>
    )
}

function useAuth() {
    const context = React.useContext(AuthContext)

    if (context === undefined) {
        throw new Error('useAuth must be used within a AuthProvider')
    }

    return context
}

async function loginUser(dispatch, values) {
    try {
        const { user, token } = values
    
        dispatch({ type: 'LOGIN', payload: values })
        await localStorage.setItem(CONFIG_NAMES.AUTH_TOKEN, token)
        await localStorage.setItem(CONFIG_NAMES.USER, JSON.stringify(user));
    } catch (e) {
        console.log(e);
    }
}

async function logout(dispatch) {
    try {
        dispatch({ type: 'LOGOUT' })

        await localStorage.removeItem(CONFIG_NAMES.AUTH_TOKEN)
        await localStorage.removeItem(CONFIG_NAMES.USER);
    } catch (e) {
        console.log(e);
    }
}

export { useAuth, AuthProvider, loginUser, logout }
