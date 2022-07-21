import * as React from 'react';
import { useState } from 'react';
import { InputAdornment, IconButton } from '@mui/material';
import Visibility from '@mui/icons-material/Visibility';
import VisibilityOff from '@mui/icons-material/VisibilityOff';
import TextInput from './TextInput';

const PasswordInput = ({
    initiallyVisible = false,
    visibilityIcon,
    visibilityOffIcon,
    ...rest
}) => {
    const [visible, setVisible] = useState(initiallyVisible);

    const handleClick = () => {
        setVisible(!visible);
    };

    return (
        <TextInput
            type={visible ? 'text' : 'password'}
            InputProps={{
                endAdornment: (
                    <InputAdornment position="end">
                        <IconButton
                            aria-label={
                                visible
                                    ? 'Mostrar'
                                    : 'Ocultar'
                            }
                            onClick={handleClick}
                            size="large"
                        >
                            {visible ? visibilityIcon : visibilityOffIcon}
                        </IconButton>
                    </InputAdornment>
                ),
            }}
            {...rest}
        />
    );
};

PasswordInput.defaultProps = {
    visibilityIcon: <Visibility />,
    visibilityOffIcon: <VisibilityOff />
}

export default PasswordInput
