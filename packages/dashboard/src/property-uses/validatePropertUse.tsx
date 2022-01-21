interface FormValues {
    name?: string;
    value?: string;
}

const validate = (values: FormValues) => {
    const errors: FormValues = {};

    if (!values.name) {
        errors.name = "Ingrese el nombre del uso";
    }
    if (!values.value) {
        errors.value = "Ingrese el valor";
    }

    return errors;
};

export default validate;