import * as React from 'react';
import { useCallback } from 'react';
import PropTypes from 'prop-types';
import FormControlLabel from '@material-ui/core/FormControlLabel';
import FormHelperText from '@material-ui/core/FormHelperText';
import FormGroup from '@material-ui/core/FormGroup';
import Checkbox from '@material-ui/core/Checkbox'
import { FieldTitle, useInput } from 'ra-core';
import { InputHelperText, InputPropTypes, sanitizeInputRestProps } from 'react-admin';

const CustomCheckbox = props => {
    const {
        format,
        label,
        fullWidth,
        helperText,
        onBlur,
        onChange,
        onFocus,
        options,
        disabled,
        parse,
        resource,
        source,
        validate,
        ...rest
    } = props;
    const {
        id,
        input: { onChange: finalFormOnChange, type, value, ...inputProps },
        isRequired,
        meta: { error, submitError, touched },
    } = useInput({
        format,
        onBlur,
        onChange,
        onFocus,
        parse,
        resource,
        source,
        type: 'checkbox',
        validate,
        ...rest,
    });

    const handleChange = useCallback(
        (event, value) => {
            finalFormOnChange(value);
        },
        [finalFormOnChange]
    );

    return (
        <FormGroup {...sanitizeInputRestProps(rest)}>
            <FormControlLabel
                control={
                    <Checkbox
                        id={id}
                        onChange={handleChange}
                        {...inputProps}
                        disabled={disabled}
                    />
                }
                label={
                    <FieldTitle
                        label={label}
                        source={source}
                        resource={resource}
                        isRequired={isRequired}
                    />
                }
            />
            <FormHelperText error={!!(error || submitError)}>
                <InputHelperText
                    touched={touched}
                    error={error || submitError}
                    helperText={helperText}
                />
            </FormHelperText>
        </FormGroup>
    );
};

CustomCheckbox.propTypes = {
    ...InputPropTypes,
    disabled: PropTypes.bool,
};

export default CustomCheckbox;
