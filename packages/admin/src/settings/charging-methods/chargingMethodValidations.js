export const validateChargingMethod = (values) => {
    const errors = {};

    if (!values.name) {
        errors.name = "Ingrese un método de pago.";
    }

    return errors;
};
