interface FormValues {
    name?: string;
    code?: string;
    state_id?: string;
    municipality_id?: string;
}
  
export default (values: FormValues) => {
    const errors: FormValues = {};

    if (!values.name) {
        errors.name = "Ingrese el nombre del estado";
    }

    if (!values.code) {
        errors.code = "Ingrese el código o identificador";
    }

    if (!values.state_id) {
        errors.state_id = 'Seleccione un estado'
    }

    if (!values.municipality_id) {
        errors.municipality_id = 'Seleccione un municipio'
    }

    return errors;
};