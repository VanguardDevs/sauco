const knex = require('knex');

const insertMovementsQuery = `
  INSERT INTO movements
    (amount, liquidation_id, payment_id, concept_id, year_id, created_at, updated_at, deleted_at)
    SELECT
        liquidations.amount,
        liquidations.id,
        payments.id,
        concept_id,
        3,
        payments.processed_at,
        payments.processed_at,
        liquidations.deleted_at
      FROM liquidations
      JOIN payment_liquidation
        ON liquidations.id = payment_liquidation.liquidation_id
      JOIN payments
        ON payment_liquidation.payment_id = payments.id
      WHERE liquidations.status_id = 2
`;

const updateYearsOfEconomicActivityMovements = (id, year) => (`
  UPDATE movements
  SET year_id = ${id}
  FROM (
    SELECT id FROM liquidations WHERE object_payment ILIKE '%${year}%'
  ) AS subquery
  WHERE movements.liquidation_id = subquery.id;
`);

async function main() {
  const db = knex(require("../knexfile"));

  try {
    /**
     * Rename tables
    */
    await db.schema.createTable('movements', (table) => {
      table.increments();
      table.decimal('amount', 15, 2);
      table.integer('liquidation_id').unsigned();
      table.integer('concept_id').unsigned();
      table.integer('payment_id').unsigned();
      table.integer('year_id').unsigned();
      table.foreign('liquidation_id').references('liquidations.id');
      table.foreign('concept_id').references('concepts.id');
      table.foreign('payment_id').references('payments.id');
      table.foreign('year_id').references('years.id');
      table.timestamps();
      table.timestamp('deleted_at').nullable();
    });

    await db.schema.raw(insertMovementsQuery);
    await db.schema.raw(updateYearsOfEconomicActivityMovements('1', '2020'));
    await db.schema.raw(updateYearsOfEconomicActivityMovements('2', '2019'));
    await db.schema.raw(updateYearsOfEconomicActivityMovements('3', '2021'));
    await db.schema.raw(`
      UPDATE movements
      SET year_id = 1
      FROM (
        SELECT liquidations.id
        FROM liquidations
        JOIN payment_liquidation
          ON liquidations.id = payment_liquidation.liquidation_id
        JOIN payments
          ON payments.id = payment_liquidation.payment_id
        WHERE
          DATE_PART('year', payments.updated_at::date) = 2020
          AND liquidation_type_id != 3
          AND status_id = 2
      ) AS subquery
      WHERE movements.liquidation_id = subquery.id;
    `);


    /**
     * Remove columns and tables
     */
    await db.schema.table('liquidations', table => {
      return table.dropColumns([
        'fine_id',
        'permit_id',
        'affidavit_id',
        'application_id',
        'withholding_id',
        'payment_id'
      ]);
    });

    await db.schema.table('deductions', table => {
      table.dropColumn('affidavit_id');
    });

    await db.schema.table('payments', table => {
      table.renameColumn('state_id', 'status_id');
      table.dropColumn('invoice_model_id');
    });

    await db.schema.dropTable('invoice_models');
    await db.schema.dropTable('settlement_reduction');
    await db.schema.dropTable('organization_payment');
    await db.schema.dropTable('organizations');
    await db.schema.dropTable('affidavit_withholding');
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
