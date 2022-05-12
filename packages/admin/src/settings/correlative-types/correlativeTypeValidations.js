export const validateCorrelativeType = (values) => {
    const errors = {};

    if (!values.description) {
        errors.description = "Ingrese un nuevo tipo de correlativo.";
    }

    return errors;
};
