import React from 'react';
import TextField from '@mui/material/TextField';
import Autocomplete from '@mui/material/Autocomplete';
import FormHelperText from '@mui/material/FormHelperText'
import FormControl from '@mui/material/FormControl'
// import { Field } from 'react-final-form'

const ControllableSelectInput = props => {
    const {
        meta: { touched, error, submitError, initial } = { touched, initial, error, submitError },
        input: { onChange, value, multiple, ...restInputProps },
        meta,
        options,
        property,
        inputProps,
        ...rest
    } = props;
    const [defaultValue] = React.useState((() => {
        if (multiple && value.length && options.length) {
            return value.filter(item => options.indexOf(item));
        } else if (!multiple && value && options.length) {
            return options.find(item => item.id == value);
        } else {
            return multiple ? [] : null;
        }
    })());

    const handleChange = (event, option) => (onChange(option.id))

    const handleMultipleChange = (event, option) => (onChange(option.map(items => items.id)))

    if (!options.length) return null;

    return (
        <FormControl className="MuiFormControl-root MuiTextField-root MuiFormControl-marginDense MuiFormControl-fullWidth" style={{ width: '100%' }}>
            <Autocomplete
                multiple={multiple}
                {...restInputProps}
                options={options}
                getOptionLabel={option => option[property]}
                renderInput={params => (
                    <TextField
                        {...params}
                        InputProps={{ ...params.InputProps, ...inputProps }}
                    />
                )}
                defaultValue={defaultValue}
                onChange={multiple ? handleMultipleChange : handleChange}
                {...rest}
            />
            {meta.error && meta.touched && <FormHelperText error>{meta.error}</FormHelperText>}
        </FormControl>
    );
}

const SelectInput = props => (
    // <Field {...props}>
    //     {props => (
            <ControllableSelectInput {...props} />
    //     )}
    // </Field>
);

ControllableSelectInput.defaultProps = {
    property: 'name',
    options: []
}

export default SelectInput;
