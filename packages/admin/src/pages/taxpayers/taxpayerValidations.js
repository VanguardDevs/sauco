export const validateItem = values => {
    const errors = {};

    if (!values.name) {
        errors.name = "Ingrese un nombre para el contribuyente.";
    }
    if (!values.rif) {
        errors.rif = "Ingrese un RIF para el contribuyente.";
    }
    if (!values.address) {
        errors.address = "Ingrese una dirección para el contribuyente.";
    }
    if (values.phone) {
        if (values.phone.length < 13) {
            errors.phone = 'El número de teléfono es muy corto.'
        }
    }

    return errors;
};
