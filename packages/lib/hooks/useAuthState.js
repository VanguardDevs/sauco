import { useDispatch, useSelector } from 'react-redux';
import { fetchUser } from '../actions';

export const useAuthState = () => {
    const store = useSelector(state => state);

    return { authenticated: store.user.isAuth };
};

export const useAuthDispatch = () => {
    const dispatch = useDispatch();

    return {
        fetchUser: () => dispatch(fetchUser()),
    }
}
