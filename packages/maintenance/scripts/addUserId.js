/**
 * Update user_id from liquidations
 * And address from liqueurs
 */

const knex = require('knex');

const UPDATE_LIQUEURS_QUERY = `
    UPDATE liqueurs
    SET address = subquery.address
    FROM (
        SELECT
            licenses.id AS license_id,
            taxpayers.fiscal_address AS address
        FROM licenses
        JOIN taxpayers ON taxpayers.id = licenses.taxpayer_id
        WHERE ordinance_id = 6
    ) AS subquery
    WHERE liqueurs.license_id = subquery.license_id;
`;

async function main() {
    const saucoDB = knex(require("../knexfile"));

    try {
        await saucoDB.schema.table('liquidations', table => {
            table.integer('user_id').nullable();
            table.foreign('user_id').references('users.id');
        });

        await saucoDB.schema.table('liqueurs', table => {
            table.string('address').nullable();
        });

        await saucoDB.schema.raw(UPDATE_LIQUEURS_QUERY);
    } finally {
        await saucoDB.destroy();
    }
}

if (!module.parent) {
    main().catch((err) => {
        console.error(err);
        process.exit(1);
    });
}

module.exports = main;
