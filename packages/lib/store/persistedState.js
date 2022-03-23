import jwtDecode from 'jwt-decode';

export const loadState = () => {
    try {
        const user = localStorage.getItem('user');
        const token = localStorage.getItem('token');

        if (!token) {
            return undefined
        }

        let parsedData = JSON.parse(user)
        const decodedToken = jwtDecode(token)

        return {
            user: {
                token: token,
                isAuth: (token) ? true : false,
                exp: decodedToken.exp,
                user: parsedData,
            }
        }
    } catch (err) {
        return undefined
    }
}
