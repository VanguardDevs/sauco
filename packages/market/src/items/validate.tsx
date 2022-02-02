interface FormValues {
    name?: string;
}

const validate = (values: FormValues) => {
    const errors: FormValues = {};

    if (!values.name) {
        errors.name = "Ingrese el nombre del rubro";
    }

    return errors;
};

export default validate
