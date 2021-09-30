const knex = require('knex');


const updateAmountColumn = (table, column) => (`
    UPDATE ${table}
    SET ${column} = ${column} / 1000000;
`);

async function main() {
    const db = knex(require("../knexfile"));

    try {
        /**
         * Rename tables
         */
        await db.schema.raw(`INSERT INTO public.tax_units(
            id, law, value, publication_date, created_at, updated_at)
            VALUES (2, 'POR DETERMINAR', '0.000017', '2021-09-30', '2021-09-30 12:57:00', '2021-09-30 12:57:00')`);
        await db.schema.table('petro_prices', table => {
            table.decimal('value', 21).alter();
        });
        await db.schema.raw(`
            UPDATE concepts
            SET amount = amount / 1000000
            WHERE charging_method_id = 3 AND amount != 0;
        `);
        await db.schema.raw(updateAmountColumn('payments', 'amount'));
        await db.schema.raw(updateAmountColumn('movements', 'amount'));
        await db.schema.raw(updateAmountColumn('liquidations', 'amount'));
        await db.schema.raw(updateAmountColumn('applications', 'amount'));
        await db.schema.raw(updateAmountColumn('fines', 'amount'));
        await db.schema.raw(updateAmountColumn('petro_prices', 'value'));
        await db.schema.raw(updateAmountColumn('affidavits', 'amount'));
        await db.schema.raw(updateAmountColumn('affidavits', 'total_brute_amount'));
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
