export const validateLiqueurParameter = (values) => {
    const errors = {};

    if (!values.name) {
        errors.name = "Ingrese un nombre para el nuevo parametro.";
    }

    return errors;
};
