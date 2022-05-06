export const validateStatus = (values) => {
    const errors = {};

    if (!values.name) {
        errors.name = "Ingrese un nuevo estado.";
    }

    return errors;
};
