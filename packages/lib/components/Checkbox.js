import * as React from 'react'
import Checkbox from '@material-ui/core/Checkbox'
import FormHelperText from '@material-ui/core/FormHelperText';

export default ({
    meta: { touched, error, submitError, initial } = { touched, initial, error, submitError },
    input: { ...inputProps },
    meta,
    children,
    ...props
}) => {

    return (
        <>
            <Checkbox
                checked={Boolean(false)}
                {...inputProps}
                {...props}
            />
            {children}
            {meta.error && meta.touched && <FormHelperText error>{meta.error}</FormHelperText>}
        </>
    )
}
