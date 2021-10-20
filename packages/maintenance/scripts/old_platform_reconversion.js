const knex = require('knex');


const updateAmountColumn = (table, column) => (`
    UPDATE ${table}
    SET ${column} = ${column} / 1000000;
`);

const alterColumn = async (table, column) => {
    const db = knex(require("../knexfile"));

    await db.schema.table(table, t => {
        t.decimal(column, 21, 8).alter();
    });
}

async function main() {
    const db = knex(require("../knexfile"));

    try {
        await alterColumn('ajuste', 'monto');
        await alterColumn('unidadtributaria', 'valor');
        await alterColumn('conceptocobro', 'monto');
        await alterColumn('cuentasxcobrar', 'monto');
        await alterColumn('cuentasxcobrar', 'saldo');
        await alterColumn('expendiosparametros', 'autorizacion');
        await alterColumn('expendiosparametros', 'renovacion');
        await alterColumn('explicorestipo', 'montoautorizacion');
        await alterColumn('explicorestipo', 'montorenovacion');
        await alterColumn('historico', 'monto');
        await alterColumn('inmueble', 'valor_avaluo');
        await alterColumn('inmueble', 'impuesto');
        await alterColumn('liquidacion', 'total');
        await alterColumn('liquidacion', 'deuda');
        await alterColumn('pago', 'monto');
        await alterColumn('pagodetalle', 'monto');
        await alterColumn('publicidadadconceptosadic', 'monto');
        await alterColumn('sanciones', 'montotributo');

        await db.schema.raw(updateAmountColumn('ajuste', 'monto'));
        await db.schema.raw(updateAmountColumn('unidadtributaria', 'valor'));
        await db.schema.raw(updateAmountColumn('conceptocobro', 'monto'));
        await db.schema.raw(updateAmountColumn('cuentasxcobrar', 'monto'));
        await db.schema.raw(updateAmountColumn('cuentasxcobrar', 'saldo'));
        await db.schema.raw(updateAmountColumn('expendiosparametros', 'autorizacion'));
        await db.schema.raw(updateAmountColumn('expendiosparametros', 'renovacion'));
        await db.schema.raw(updateAmountColumn('explicorestipo', 'montoautorizacion'));
        await db.schema.raw(updateAmountColumn('explicorestipo', 'montorenovacion'));
        await db.schema.raw(updateAmountColumn('historico', 'monto'));
        await db.schema.raw(updateAmountColumn('inmueble', 'valor_avaluo'));
        await db.schema.raw(updateAmountColumn('inmueble', 'impuesto'));
        await db.schema.raw(updateAmountColumn('liquidacion', 'total'));
        await db.schema.raw(updateAmountColumn('liquidacion', 'deuda'));
        await db.schema.raw(updateAmountColumn('pago', 'monto'));
        await db.schema.raw(updateAmountColumn('pagodetalle', 'monto'));
        await db.schema.raw(updateAmountColumn('publicidadadconceptosadic', 'monto'));
        await db.schema.raw(updateAmountColumn('sanciones', 'montotributo'));
    } finally {
        await db.destroy();
    }
}

if (!module.parent) {
    main().catch((err) => {
        console.error(err);
        process.exit(1);
    });
}

module.exports = main;
