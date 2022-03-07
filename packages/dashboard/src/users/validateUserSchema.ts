const validate = (values: FormValues) => {
    const errors: FormValues = {};

    if (!values.full_name) {
        errors.full_name = "Ingrese el nombre.";
    }
    if (!values.login) {
        errors.login = "Ingrese un nombre de usuario.";
    }
    if (!values.password && values.isCreateForm) {
        errors.password = "Ingrese una contraseña.";
    }
    if (!values.identity_card) {
        errors.identity_card = "Ingrese la cédula de identidad.";
    }
    if (!values.roles_ids == null) {
        errors.roles_ids = "Seleccione un rol.";
    }

    return errors;
}

interface FormValues {
    full_name?: string;
    roles_ids?: string;
    identity_card?: string;
    login?: string;
    password?: string;
    name?: string;
    isCreateForm?: boolean;
}

export default validate;