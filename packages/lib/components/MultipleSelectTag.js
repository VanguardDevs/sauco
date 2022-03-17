import * as React from 'react'
import Select from '@material-ui/core/Select';
import MenuItem from '@material-ui/core/MenuItem';
import FormControl from '@material-ui/core/FormControl';
import ListItemText from '@material-ui/core/ListItemText';
import Checkbox from '@material-ui/core/Checkbox';
import {
    InputLabel,
    FormHelperText
} from '@material-ui/core';
import {
    FieldTitle,
    useInput,
    useChoices,
    Labeled,
    LinearProgress,
    InputHelperText,
    useSupportCreateSuggestion,
} from 'react-admin';
import isEmpty from 'is-empty'

const MultipleSelectTag = props => {
    const {
        choices = [],
        classes: classesOverride,
        className,
        create,
        createLabel,
        createValue,
        disableValue,
        format,
        helperText,
        label,
        loaded,
        loading,
        value = [],
        margin = 'dense',
        onBlur,
        onChange,
        onCreate,
        onFocus,
        options,
        optionText,
        optionValue,
        parse,
        resource,
        source,
        translateChoice,
        validate,
        variant = 'filled',
        ...rest
    } = props;
    const inputLabel = React.useRef(null);
    const [labelWidth, setLabelWidth] = React.useState(0);

    React.useEffect(() => {
        // Will be null while loading and we don't need this fix in that case
        if (inputLabel.current) {
            setLabelWidth(inputLabel.current.offsetWidth);
        }
    }, []);

    const { getChoiceText, getChoiceValue, getDisableValue } = useChoices({
        optionText,
        optionValue,
        disableValue,
        translateChoice,
    });
    const {
        input,
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
        validate,
        ...rest,
    });

    const handleChange = React.useCallback(
        (event, newItem) => {
            if (newItem) {
                input.onChange([...input.value, getChoiceValue(newItem)]);
                return;
            }
            input.onChange(event);
        },
        [input, getChoiceValue]
    );

    const {
        getCreateItem,
        handleChange: handleChangeWithCreateSupport,
        createElement,
    } = useSupportCreateSuggestion({
        create,
        createLabel,
        createValue,
        handleChange,
        onCreate,
        optionText,
    });

    const createItem = create || onCreate ? getCreateItem() : null;
    const finalChoices =
        create || onCreate ? [...choices, createItem] : choices;

    const renderMenuItem = React.useCallback(
        choice => {
            return choice ? (
                <MenuItem
                    key={getChoiceValue(choice)}
                    value={getChoiceValue(choice)}
                    disabled={getDisableValue(choice)}
                >
                    <ListItemText key={choice.id} primary={choice.name} />
                    <Checkbox checked={input.value.includes(choice.id)} />
                </MenuItem>
            ) : null;
        },
        [getChoiceValue, getDisableValue, createItem, input]
    );

    if (loading) {
        return (
            <Labeled
                label={label}
                source={source}
                resource={resource}
                className={className}
                isRequired={isRequired}
                margin={margin}
            >
                <LinearProgress />
            </Labeled>
        );
    }

    return (
        <>
            <FormControl
                margin={margin}
                error={touched && !!(error || submitError)}
                variant={variant}
                {...rest}
            >
                <InputLabel
                    ref={inputLabel}
                    id={`${label}-outlined-label`}
                    error={touched && !!(error || submitError)}
                >
                    <FieldTitle
                        label={label}
                        source={source}
                        resource={resource}
                        isRequired={isRequired}
                    />
                </InputLabel>
                <Select
                    autoWidth
                    labelId={`${label}-outlined-label`}
                    multiple
                    error={!!(touched && (error || submitError))}
                    renderValue={selected => {
                        return (
                            <div>
                                {selected
                                    .map(item =>
                                        choices.find(
                                            choice =>
                                                getChoiceValue(choice) === item
                                        )
                                    )
                                    .filter(item => !!item)
                                    .map(i => i.name).join(', ')}
                            </div>
                        )
                    }}
                    data-testid="selectArray"
                    {...input}
                    onChange={handleChangeWithCreateSupport}
                    value={input.value || []}
                    {...options}
                    fullWidth
                >
                    {finalChoices.map(renderMenuItem)}
                </Select>
                <FormHelperText error={touched && !!(error || submitError)}>
                    <InputHelperText
                        touched={touched}
                        error={error || submitError}
                        helperText={helperText}
                    />
                </FormHelperText>
            </FormControl>
            {createElement}
        </>
    );
};

export default MultipleSelectTag;
