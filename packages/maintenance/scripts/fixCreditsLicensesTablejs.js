const knex = require('knex');

async function main() {
    const db = knex(require("../knexfile"));

    try {
        await db.schema.table('licenses', (table) => {
            table.integer('liquidation_id').unsigned().nullable();
            table.foreign('liquidation_id').references('liquidations.id').onDelete('cascade');
        });

        await db.schema.table('credits', (table) => {
            table.integer('liquidation_id').unsigned().nullable();
            table.foreign('liquidation_id').references('liquidations.id').onDelete('cascade');
        });

        await db.schema.raw(
            `
                ALTER TABLE credits ALTER COLUMN generated_at DROP NOT NULL;
                ALTER TABLE credits ALTER COLUMN payment_id DROP NOT NULL;
            `
        );

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
