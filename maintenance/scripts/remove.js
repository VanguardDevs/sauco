const knex = require('knex');

/**
 * Drop all unnecessary columns and tables
 */
async function main() {
  const db = knex(require("../knexfile"));

  try {
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
