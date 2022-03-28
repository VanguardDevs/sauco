export const validateZone = (values) => {
    const errors = {};

    if (!values.name) {
        errors.name = "Ingrese un nombre para la nueva zona.";
    }

    return errors;
};
