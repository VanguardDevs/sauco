const knex = require('knex');

const insertManyDeductionLiquidationQuery = `
  INSERT INTO deduction_liquidation
    (liquidation_id, deduction_id, created_at, updated_at)
  SELECT liquidations.id, deductions.id, deductions.created_at, deductions.created_at
    FROM liquidations JOIN deductions
    ON liquidations.withholding_id = deductions.id
`;

async function liquidations() {
  const db = knex(require("../knexfile"));

  try {
    /**
     * Rename tables
     */ 

    await db.schema.renameTable('null_withholdings', 'canceled_deductions');

    await db.schema.table('canceled_deductions', (table) => {
      table.renameColumn('withholding_id', 'deduction_id');
    });

    await db.schema.renameTable('withholdings', 'deductions');

    await db.schema.createTable('deduction_liquidation', (table) => {
      table.increments();
      table.integer('liquidation_id').unsigned();
      table.integer('deduction_id').unsigned();
      table.timestamps();
      table.foreign('liquidation_id').references('liquidations.id');
      table.foreign('deduction_id').references('deductions.id');
    });

    await db.schema.raw(insertManyDeductionLiquidationQuery);

    /**
     * Update liquidations by type
     */
    await setNewColumnValues('fine_id', 'App\\Models\\Fine', 2); 
    await setNewColumnValues('affidavit_id', 'App\\Models\\Affidavit', 3); 
    await setNewColumnValues('application_id', 'App\\Models\\Application', 1); 
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
