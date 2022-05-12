export const validatePetroPrice = (values) => {
    const errors = {};

    if (!values.value) {
        errors.value = "Ingrese un valor.";
    }

    return errors;
};
