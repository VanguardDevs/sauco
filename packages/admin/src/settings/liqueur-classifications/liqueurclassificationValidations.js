export const validateLiqueurClassification = (values) => {
    const errors = {};

    if (!values.name) {
        errors.name = "Ingrese un nombre para la nueva clasificación.";
    }
    if (!values.abbreviature) {
        errors.abbreviature = "Ingrese un nombre para la nueva abreviatura.";
    }

    return errors;
};
