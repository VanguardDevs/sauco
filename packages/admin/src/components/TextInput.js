import React from 'react';
import TextField from '@mui/material/TextField';
import FormHelperText from '@mui/material/FormHelperText'
import FormControl from '@mui/material/FormControl'
import { Field } from 'react-final-form'

const ControllableTextInput = props => {
    const {
        meta: { touched, error, submitError, initial } = { touched, initial, error, submitError },
        input,
        meta,
        fullWidth,
        source,
        ...rest
    } = props;

    return (
        <FormControl fullWidth className="MuiFormControl-root MuiTextField-root MuiFormControl-marginDense MuiFormControl-fullWidth">
            <TextField {...input} {...rest} />
            {(meta.error || submitError ) && meta.touched && <FormHelperText error>{meta.error || submitError}</FormHelperText>}
        </FormControl>
    );
}

const TextInput = props => (
    <Field
        component={ControllableTextInput}
        {...props}
    />
);

export default TextInput;
