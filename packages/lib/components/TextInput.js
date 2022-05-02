import React from 'react';
import TextField from '@material-ui/core/TextField';
import FormHelperText from '@material-ui/core/FormHelperText'
import FormControl from '@material-ui/core/FormControl'
import { Field } from 'react-final-form'

const ControllableTextInput = props => {
    const {
        meta: { touched, error, submitError, initial } = { touched, initial, error, submitError },
        input,
        meta
    } = props;

    return (
        <FormControl className="MuiFormControl-root MuiTextField-root MuiFormControl-marginDense MuiFormControl-fullWidth">
            <TextField {...input} />
            {meta.error && meta.touched && <FormHelperText error>{meta.error}</FormHelperText>}
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
