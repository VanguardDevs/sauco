import * as React from 'react'
import Box from '@material-ui/core/Box'
import Grid from '@material-ui/core/Grid'
import Typography from '@material-ui/core/Typography'
import { Form } from 'react-final-form'
import Button from './Button'
import merge from 'lodash/merge';

const getFormInitialValues = (
    initialValues,
    defaultValue,
    record
) => {
    if (typeof defaultValue !== 'undefined') {
        console.warn(
            '"defaultValue" is deprecated, please use "initialValues" instead'
        );
    }

    const finalInitialValues = merge(
        {},
        getValues(defaultValue, record),
        getValues(initialValues, record),
        record
    );
    return finalInitialValues;
}

function getValues(values, record) {
    if (typeof values === 'object') {
        return values;
    }

    if (typeof values === 'function') {
        return values(record);
    }

    return {};
}

const BaseForm: React.FC<BaseFormProps> = ({
    title,
    children,
    buttonName,
    noButton,
    unresponsive,
    icon,
    validate,
    save,
    record,
    initialValues,
    defaultValue,
    ...rest
}) => {
    const finalInitialValues = React.useMemo(
        () => getFormInitialValues(initialValues, defaultValue, record),
        [JSON.stringify({ initialValues, defaultValue, record })] // eslint-disable-line
    );

    return (
        <Box component='div'>
            { title && <Typography component='h1' variant='h5'>{title}</Typography> }
            <Box component='div' paddingTop='2rem'>
                <Form
                    onSubmit={save}
                    validate={validate}
                    initialValues={finalInitialValues}
                    {...rest}
                    render={ ({ handleSubmit, submitting }) => (
                        <form id="exampleForm" onSubmit={handleSubmit}>
                            <Box maxWidth="90em">
                                <Grid container spacing={1}>
                                    {
                                        React.Children.map(children, (child: any) =>
                                            React.cloneElement(child, {
                                                disabled: submitting
                                            })
                                        )
                                    }
                                    {!noButton && (
                                        <Grid container>
                                            <Grid item xs={12} sm={12} md={4} lg={3}>
                                                <Button
                                                    disabled={submitting}
                                                    onClick={event => {
                                                        if (event) {
                                                            event.preventDefault();
                                                            handleSubmit();
                                                        }
                                                    }}
                                                    unresponsive={unresponsive}
                                                    type="submit"
                                                    icon={icon}
                                                >
                                                    {buttonName}
                                                </Button>
                                            </Grid>
                                        </Grid>
                                    )}
                                </Grid>
                            </Box>
                        </form>
                    )}
                />
            </Box>
        </Box>
    );
}

interface BaseFormProps {
    title?: any;
    buttonName?: string;
    disabled?: boolean;
    noButton?: any;
    unresponsive?: any;
    validate?: any;
    save: any;
    icon?: React.ReactNode,
    record?: any;
    initialValues?: any;
    defaultValue?: any;
}

BaseForm.defaultProps = {
    buttonName: 'Guardar',
    disabled: false,
    noButton: false,
    unresponsive: false,
}

export default BaseForm;
