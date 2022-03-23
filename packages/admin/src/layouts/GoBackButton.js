import * as React from 'react';
import {
    Tooltip,
    IconButton,
    styled
} from '@material-ui/core';
import { useHistory } from 'react-router-dom'
import ArrowBackIosIcon from '@material-ui/icons/ArrowBackIos';

const CustomIconButton = styled(IconButton)(({ theme }) => ({
    color: `${theme.palette.primary.main} !important`,
}));

const ToggleSidebarButton = () => {
    const history = useHistory();

    return (
        <Tooltip
            title='Regresar'
            enterDelay={500}
        >
            <CustomIconButton
                onClick={() => history.goBack()}
            >
                <ArrowBackIosIcon />
            </CustomIconButton>
        </Tooltip>
    );
};

export default ToggleSidebarButton;
