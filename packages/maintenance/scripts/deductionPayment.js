const knex = require('knex');

const setDeductionsQuery = `
    UPDATE deductions
    SET
        payment_id = subquery.payment_id
    FROM (
        SELECT deductions.id, payment_liquidation.payment_id
            FROM deductions
            JOIN liquidations
                ON deductions.liquidation_id = liquidations.id
            JOIN payment_liquidation ON payment_liquidation.liquidation_id = liquidations.id
    )
    AS subquery
    WHERE deductions.id = subquery.id;
`;

async function main() {
    const db = knex(require("../knexfile"));

    try {
        await db.schema.table('deductions', table => {
            table.integer('payment_id').unsigned().nullable();
            table.foreign('payment_id').references('payments.id');
        });

        await db.schema.raw(setDeductionsQuery);
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
