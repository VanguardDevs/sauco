const validate = (values: FormValues) => {
    const errors: FormValues = {};

    if (!values.name) {
        errors.name = "Ingrese el nombre.";
    }
    if (!values.charging_method_id) {
        errors.charging_method_id = "Seleccione un tipo de método de carga.";
    }
    if (!values.ordinance_id) {
        errors.ordinance_id = "Seleccione una ordenanza.";
    }
    if (!values.accounting_account_id) {
        errors.accounting_account_id = "Seleccione una cuenta contable.";
    }
    if (!values.liquidation_type_id) {
        errors.liquidation_type_id = "Seleccione un tipo de liquidación.";
    }
    if (!values.amount) {
        errors.amount = "Ingrese un monto para el cobro (Mínimo 0).";
    }
    if (!values.code) {
        errors.code = "Ingrese un código para el concepto de recaudación";
    }

    return errors;
}

interface FormValues {
    accounting_account_id?: string;
    amount?: string;
    liquidation_type_id?: string;
    charging_method_id?: string;
    ordinance_id?: string;
    name?: string;
    code?: string;
}

export default validate;