const knex = require('knex');

const insertRowsQuery = `
  INSERT INTO affidavit_fine
    (fine_id, affidavit_id, created_at, updated_at)
    SELECT fine_id, affidavit_id, q1.created_at, q1.updated_at
    FROM (
      SELECT fine_id, payment_id, created_at, updated_at
      FROM settlements
      WHERE fine_id IS NOT NULL
        AND payment_id
        IN (SELECT
          payment_id
          FROM settlements
          WHERE
            deleted_at IS NULL
          GROUP BY payment_id
          HAVING COUNT(*) > 1)
        ) AS q1
    JOIN (
      SELECT affidavit_id, payment_id
      FROM settlements
      WHERE affidavit_id IS NOT NULL
        AND payment_id
          IN (
            SELECT payment_id
            FROM settlements
            WHERE deleted_at IS NULL
            GROUP BY payment_id HAVING COUNT(*) > 1)
            ) AS q2 ON q2.payment_id = q1.payment_id;
`;

async function main() {
  const db = knex(require("../knexfile"));

  try {
    /**
     * Rename tables
    */
    await db.schema.createTable('affidavit_fine', (table) => {
      table.increments();
      table.integer('affidavit_id').unsigned();
      table.integer('fine_id').unsigned();
      table.foreign('fine_id').references('fines.id');
      table.foreign('affidavit_id').references('affidavits.id');
      table.timestamps();
      table.timestamp('deleted_at').nullable();
    });

    await db.schema.raw(insertRowsQuery);
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
