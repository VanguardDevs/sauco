export const validateConcept = (values) => {
    const errors = {};

    if (!values.code) {
        errors.code = "Ingrese un codigo para el concepto.";
    }

    if (!values.name) {
        errors.name = "Ingrese un nombre para el concepto.";
    }

    return errors;
};
