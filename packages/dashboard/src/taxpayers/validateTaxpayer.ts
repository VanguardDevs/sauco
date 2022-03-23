interface FormValues {
    rif?: string,
    name?: string,
    address?: string,
    phone?: string,
    email?: string,
    parish_id?: string,
    municipality_id?: string,
    state_id?: string,
    taxpayer_type_id?: string,
    taxpayer_classification_id?: string
}

export default (values: FormValues) => {
    const errors: FormValues = {};

    if (!values.name) {
        errors.name = "Ingrese el nombre del estado";
    }
    if (!values.rif) {
        errors.rif = "Ingrese el RIF del contribuyente";
    }
    if (!values.address) {
        errors.address = "Ingrese la dirección del contribuyente";
    }
    if (!values.parish_id) {
        errors.parish_id = "Seleccione una parroquia";
    }
    if (!values.municipality_id) {
        errors.municipality_id = "Seleccione un municipio";
    }
    if (!values.taxpayer_type_id) {
        errors.taxpayer_type_id = "Seleccione un tipo de contribuyente";
    }
    if (!values.taxpayer_classification_id) {
        errors.taxpayer_classification_id = "Seleccione una clasificación para el contribuyente";
    }
    if (!values.state_id) {
        errors.state_id = "Seleccione un estado";
    }

    return errors;
};
