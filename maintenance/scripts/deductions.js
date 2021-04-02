const knex = require('knex');

const insertManyDeductionLiquidationQuery = `
  UPDATE deductions
  SET
    liquidation_id = subquery.id
  FROM (
    SELECT liquidations.id, liquidations.liquidable_id
    FROM liquidations
    WHERE liquidable_type = 'App\\Models\\Affidavit'
  )
  AS subquery
  WHERE affidavit_id = subquery.liquidable_id
`;

async function main() {
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

    await db.schema.table('deductions', (table) => {
      table.integer('liquidation_id').unsigned();
      table.foreign('liquidation_id').references('liquidations.id');
    });

    await db.schema.raw(insertManyDeductionLiquidationQuery);
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
