export const validateColor = (values) => {
    const errors = {};

    if (!values.name) {
        errors.name = "Ingrese un nombre para el nuevo color.";
    }

    return errors;
};