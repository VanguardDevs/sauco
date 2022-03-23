interface FormValues {
    name?: string;
    code?: string;
}
  
export default (values: FormValues) => {
    const errors: FormValues = {};

    if (!values.name) {
        errors.name = "Ingrese el nombre del estado";
    }

    if (!values.code) {
        errors.code = "Ingrese el código o identificador";
    }

    return errors;
};