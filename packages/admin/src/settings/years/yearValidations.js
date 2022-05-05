export const validateYear = (values) => {
    const errors = {};

    if (!values.year) {
        errors.year = "Ingrese un nuevo año.";
    }

    return errors;
};
