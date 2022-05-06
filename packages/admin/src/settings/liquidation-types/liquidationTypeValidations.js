export const validateLiquidationType = (values) => {
    const errors = {};

    if (!values.name) {
        errors.name = "Ingrese un nuevo tipo de liquidación.";
    }

    return errors;
};
