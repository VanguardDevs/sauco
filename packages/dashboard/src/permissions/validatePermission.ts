interface FormValues {
    name?: string;
}
  
export default (values: FormValues) => {
    const errors: FormValues = {};

    if (!values.name) {
        errors.name = "Ingrese el nombre del permiso";
    }

    return errors;
};