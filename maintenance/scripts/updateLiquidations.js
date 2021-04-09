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

  // Update and drop columns
  const setNewColumnValues = async (originalColumn, liquidableType, id) => {
    await db('liquidations')
      .whereNotNull(originalColumn)
      .update({
        'status_id': '2',
        'liquidable_id': db.ref(originalColumn),
        'liquidable_type': liquidableType,
        'liquidation_type_id': id.toString(),
      })
      .catch((error) => console.log(error));
  };

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
      table.integer('liquidation_type_id').unsigned();
      table.integer('status_id').unsigned();
      table.foreign('liquidation_type_id').references('liquidation_types.id');
      table.foreign('status_id').references('status.id');
    });

    await db.schema.raw(insertManyPaymentLiquidationQuery);

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
