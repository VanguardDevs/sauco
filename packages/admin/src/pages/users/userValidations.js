const generalUserValidations = values => {
    const errors = {};

    if (!values.names) {
        errors.names = "Ingrese el nombre de la persona.";
    }
    if (!values.identity_card) {
        errors.identity_card = "Ingrese la cédula de identidad.";
    }
    if (!values.login) {
        errors.login = "Ingrese un login.";
    }
    if (!values.surnames) {
        errors.surnames = "Ingrese el apellido.";
    }

    return errors;
}

export const validateCreateUser = (values) => {
    let errors = {};

    errors = { ...generalUserValidations(values)}

    if (!values.password) {
        errors.password = 'Ingrese una contraseña';
    } else if (values.password.length <= 5) {
        errors.password = 'La contraseña debe tener más de 5 caracteres'
    }
    if (!values.roles_ids) {
        errors.roles_ids = 'Seleccione uno o más roles';
    }

    return errors;
};

export const validateEditUser = (values) => {
    let errors = {};
    errors = { ...generalUserValidations(values)}

    if (!values.roles.length) {
        errors.roles = 'Seleccione uno o más roles';
    }

    return errors;
};
