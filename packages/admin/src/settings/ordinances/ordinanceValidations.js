export const validateOrdinance = (values) => {
    const errors = {};

    if (!values.description) {
        errors.description = "Ingrese una descripción para la nueva ordenanza.";
    }

    return errors;
};
