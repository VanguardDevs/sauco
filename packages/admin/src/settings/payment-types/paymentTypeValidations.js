export const validatePaymentType = (values) => {
    const errors = {};

    if (!values.description) {
        errors.description = "Ingrese un nuevo tipo de pago.";
    }

    return errors;
};
