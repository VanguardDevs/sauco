const knex = require('knex');

const addTaxpayerID = `
  UPDATE liquidations 
  SET 
    taxpayer_id = subquery.taxpayer_id
  FROM (
    SELECT liquidations.id, payments.taxpayer_id
    FROM payments JOIN liquidations 
    ON liquidations.payment_id = payments.id
  )
  AS subquery
  WHERE liquidations.id = subquery.id
`;

async function liquidations() {
  const db = knex(require("../knexfile"));

  // Update and drop columns
  const setNewColumnValues = async (originalColumn, liquidableType, id) => {
    await db('liquidations')
      .whereNotNull(originalColumn)
      .update({
        'liquidable_id': db.ref(originalColumn),
        'liquidable_type': liquidableType,
        'liquidation_type_id': id.toString(),
      })
      .catch((error) => console.log(error));
  };

  try {
    /**
     * Rename and create new tables
     */ 
    await db.schema.renameTable('lists', 'liquidation_types');

    await db.schema.table('concepts', (table) => {
      table.renameColumn('list_id', 'liquidation_type_id');
    });

    await db.schema.renameTable('settlements', 'liquidations');

    /**
     * Set new columns to liquidations table
     */
    await db.schema.table('liquidations', (table) => {
      table.string('liquidable_type');
      table.integer('liquidable_id').unsigned();
      table.integer('liquidation_type_id').unsigned();
      table.foreign('liquidation_type_id').references('liquidation_types.id');
    });

    /**
     * Update liquidations by type
     */
    await setNewColumnValues('fine_id', 'App\\Models\\Fine', 2); 
    await setNewColumnValues('affidavit_id', 'App\\Models\\Affidavit', 3); 
    await setNewColumnValues('application_id', 'App\\Models\\Application', 1); 

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
  liquidations().catch((err) => {
    console.error(err);
    process.exit(1);
  });
}

module.exports = liquidations;
