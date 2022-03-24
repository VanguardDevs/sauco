export const validateModel = (values) => {
    const errors = {};

    if (!values.name) {

        errors.name = "Ingrese un nombre para el modelo.";
    }
    if (!values.brand) {

        errors.brand = "Ingrese una marca.";
    }

    return errors;
};
