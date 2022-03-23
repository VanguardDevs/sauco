export const validateBrand = (values) => {
    const errors = {};

    if (!values.name) {
        errors.name = "Ingrese un nombre para el nuevo nivel.";
    }

    return errors;
};
