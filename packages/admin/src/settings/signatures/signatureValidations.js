export const validateSignature = (values) => {
    const errors = {};

    if (!values.title) {
        errors.title = "Ingrese un título para el nueva firma.";
    }
    if (!values.decree) {
        errors.decree = "Ingrese un decreto para el nueva firma.";
    }
    if (!values.active) {
        errors.active = "Seleccione estado.";
    }
    if (!values.user_id) {
        errors.user_id = "Seleccione usuario.";
    }

    return errors;
};
