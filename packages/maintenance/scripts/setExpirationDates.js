const knex = require('knex');

const updateAmountColumn = () => (`
    UPDATE licenses
        SET expiration_date = emission_date + interval '1 year'
        WHERE emission_date::text LIKE '%2021%'
        AND deleted_at IS NULL;
`);

async function main() {
    const db = knex(require("../knexfile"));

    try {
        await db.schema.raw(updateAmountColumn());
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
