const knex = require('knex');

async function main() {
  const db = knex(require("../knexfile"));

  try {
    /**
     * Drop all unnecessary columns from liquidations table
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

module.exports = liquidations;
