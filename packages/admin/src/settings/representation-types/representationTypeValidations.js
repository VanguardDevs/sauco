export const validateRepresentationType = (values) => {
    const errors = {};

    if (!values.name) {
        errors.name = "Ingrese un tipo de representante.";
    }

    return errors;
};
