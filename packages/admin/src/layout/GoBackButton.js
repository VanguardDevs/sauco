import * as React from 'react';
import { styled } from '@mui/system';
import ArrowBackIcon from '@mui/icons-material/ArrowBack';
import { useNavigate, useLocation } from 'react-router-dom'
import IconButton from '@mui/material/IconButton';
import Tooltip from '@mui/material/Tooltip';

const CustomIconButton = styled(IconButton)(() => ({
    color: `#fff !important`,
}));

const ToggleSidebarButton = () => {
    const navigate = useNavigate();
    const { state } = useLocation();

    if (state) return null;

    return (
        <Tooltip
            title='Regresar'
            enterDelay={500}
        >
            <CustomIconButton onClick={() => navigate(-1)}>
                <ArrowBackIcon />
            </CustomIconButton>
        </Tooltip>
    );
};

export default ToggleSidebarButton;
