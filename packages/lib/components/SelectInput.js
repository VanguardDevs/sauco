import React from 'react';
import TextField from '@material-ui/core/TextField';
import Autocomplete from '@material-ui/lab/Autocomplete';
import FormHelperText from '@material-ui/core/FormHelperText'
import FormControl from '@material-ui/core/FormControl'
import { Field } from 'react-final-form'

const ControllableSelectInput = props => {
    const {
        meta: { touched, error, submitError, initial } = { touched, initial, error, submitError },
        input: { onChange,  name },
        meta,
        options,
        property,
        record,
        inputProps
    } = props;
    const [value, setValue] = React.useState(null);

    const handleChange = (e, value) => {
        setValue(value)
        if (value) onChange(value.id)
    }

    React.useEffect(() => {
        if (record != null && options.length) {
            const value = options.find(item => item.id == record[name]);

            setValue(value)
            handleChange(event, value)
        }
    }, [record, options])

    if (!options.length) return null;

    return (
        <FormControl className="MuiFormControl-root MuiTextField-root MuiFormControl-marginDense MuiFormControl-fullWidth">
            <Autocomplete
                name={name}
                fullWidth
                value={value}
                options={options}
                getOptionLabel={(option) => option[property]}
                renderInput={(params) => (
                    <TextField
                        {...params}
                        {...inputProps}
                    />
                )}
                onChange={handleChange}
            />
            {meta.error && meta.touched && <FormHelperText error>{meta.error}</FormHelperText>}
        </FormControl>
    );
}

const Select = props => (
    <Field
        component={ControllableSelectInput}
        {...props}
    />
);

ControllableSelectInput.defaultProps = {
    property: 'name'
}

export default Select;
