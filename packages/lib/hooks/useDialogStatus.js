import { useDispatch, useSelector } from 'react-redux';
import { setDialog, unsetDialog } from '../actions';

export const useDialogState = name => {
    const store = useSelector(state => state);

    return (store.dialog.name === name) && store.dialog.status
};

export const useDialogDispatch = name => {
    const dispatch = useDispatch();

    return {
        setDialog: () => dispatch(setDialog(name)),
        unsetDialog: () => dispatch(unsetDialog(name))
    }
}
