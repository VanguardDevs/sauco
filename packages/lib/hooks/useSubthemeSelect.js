import { useDispatch, useSelector } from 'react-redux';
import { setSubtheme, unsetSubtheme } from '../actions';

export const useSubthemeState = () => {
    const store = useSelector(state => state);

    return store.trivia.selectedSubthemes;
};

export const useSubthemesDispatch = () => {
    const dispatch = useDispatch();

    return {
        setSubtheme: data => dispatch(setSubtheme(data)),
        unsetSubtheme: data => dispatch(unsetSubtheme(data))
    }
}
