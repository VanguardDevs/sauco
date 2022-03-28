export const validateAnnex = (values) => {
    const errors = {};

    if (!values.name) {
        errors.name = "Ingrese un nombre para el nuevo anexo.";
    }

    return errors;
};
