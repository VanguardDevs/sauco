import TextField from '@material-ui/core/TextField';

const renderInput = ({
    meta: { touched, error, submitError } = { touched, error, submitError },
    input: { ...inputProps },
    ...props
}) => (
    <TextField
        error={!!(touched && error || submitError)}
        helperText={touched && error || submitError}
        {...inputProps}
        {...props}
        fullWidth
    />
);

export default renderInput;
