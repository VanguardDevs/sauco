import React from 'react';
import TextField from '@mui/material/TextField';
import FormHelperText from '@mui/material/FormHelperText'
import FormControl from '@mui/material/FormControl'
import { useController } from "react-hook-form";

const TextInput = ({ InputProps, type, ...rest}) => {
    const {
        field: { onChange, onBlur, name, value, ref },
        fieldState: { invalid, isTouched, isDirty },
        formState: { isSubmitting, errors }
    } = useController(rest);

    return (
        <FormControl fullWidth className="MuiFormControl-root MuiTextField-root MuiFormControl-marginDense MuiFormControl-fullWidth">
            <TextField
                onChange={onChange}
                onBlur={onBlur}
                value={value}
                name={name}
                inputRef={ref}
                disabled={isSubmitting}
                InputProps={InputProps}
                type={type}
            />
            {(errors[name]) && isTouched && <FormHelperText error>{errors[name][0]}</FormHelperText>}
        </FormControl>
    );
}

export default TextInput;
