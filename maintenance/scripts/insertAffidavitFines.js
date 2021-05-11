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

const setBruteAmounts = `
  UPDATE affidavits
  SET
    total_brute_amount = subquery.total_brute_amount
  FROM (
    SELECT affidavits.id, SUM(brute_amount) AS total_brute_amount
    FROM affidavits
    JOIN economic_activity_affidavit
      ON affidavits.id = economic_activity_affidavit.affidavit_id
    GROUP BY (affidavits.id)
  )
  AS subquery
  WHERE affidavits.id = subquery.id
`;


async function main() {
  const db = knex(require("../knexfile"));

  try {
    await db.schema.raw(insertRowsQuery);

    await db.schema.table('affidavits', (table) => {
      table.decimal('total_brute_amount', 25);
      table.renameColumn('amount', 'total_calc_amount');
    });

    await db.schema.raw(setBruteAmounts);
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
