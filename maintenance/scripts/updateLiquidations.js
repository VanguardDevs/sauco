const knex = require('knex');

const insertManyPaymentLiquidationQuery = `
  INSERT INTO payment_liquidation
    (liquidation_id, payment_id, created_at, updated_at)
  SELECT liquidations.id, payments.id, payments.created_at, payments.created_at
    FROM liquidations JOIN payments
    ON liquidations.payment_id = payments.id
`;

async function liquidations() {
  const db = knex(require("../knexfile"));

  try {
    /**
     * Rename tables
     */
    await db.schema.renameTable('lists', 'liquidation_types');

    await db.schema.table('concepts', (table) => {
      table.renameColumn('list_id', 'liquidation_type_id');
    });

    await db.schema.renameTable('settlements', 'liquidations');

    /**
     * Create new tables
     */
    await db.schema.createTable('payment_liquidation', (table) => {
      table.increments();
      table.integer('liquidation_id').unsigned();
      table.integer('payment_id').unsigned();
      table.timestamps();
      table.foreign('liquidation_id').references('liquidations.id');
      table.foreign('payment_id').references('payments.id');
    });

    /**
     * Set new columns to liquidations table
     */
    await db.schema.table('liquidations', (table) => {
      table.string('liquidable_type');
      table.integer('liquidable_id').unsigned();
      table.integer('concept_id').unsigned();
      table.integer('liquidation_type_id').unsigned();
      table.integer('status_id').unsigned();
      table.foreign('liquidation_type_id').references('liquidation_types.id');
      table.foreign('concept_id').references('concepts.id');
      table.foreign('status_id').references('status.id');
    });

    await db.schema.raw(insertManyPaymentLiquidationQuery);

    /**
     * Update liquidations by type
     */
    await db.schema.raw(
      `
      UPDATE liquidations
      SET
        concept_id = applications.concept_id,
        liquidable_id = application_id,
        liquidable_type = 'App\\Models\\Application',
        liquidation_type_id = 1
      FROM applications
      WHERE applications.id = liquidations.application_id
      `
    );

    await db.schema.raw(
      `
      UPDATE liquidations
      SET
        concept_id = 1,
        liquidable_id = affidavit_id,
        liquidable_type = 'App\\Models\\Affidavit',
        liquidation_type_id = 3
      FROM affidavits
      WHERE affidavits.id = liquidations.affidavit_id
      `
    );

    await db.schema.raw(
      `
      UPDATE liquidations
      SET
        concept_id = fines.concept_id,
        liquidable_id = fine_id,
        liquidable_type = 'App\\Models\\Fine',
        liquidation_type_id = 2
      FROM fines
      WHERE fines.id = liquidations.fine_id
      `
    );

    await db.schema.raw(`
      UPDATE liquidations
      SET status_id = state_id
      FROM payments
      WHERE liquidations.payment_id = payments.id
    `);
  } finally {
    await db.destroy();
  }
}

if (!module.parent) {
  liquidations().catch((err) => {
    console.error(err);
    process.exit(1);
  });
}

module.exports = liquidations;
