const knex = require('knex');

const addTaxpayerID = `
  UPDATE settlements 
  SET 
    taxpayer_id = subquery.taxpayer_id
  FROM (
    SELECT settlements.id, payments.taxpayer_id
    FROM payments JOIN settlements 
    ON settlements.payment_id = payments.id
  )
  AS subquery
  WHERE settlements.id = subquery.id
`;

async function liquidations() {
  const db = knex(require("../knexfile"));

  try {
    // Update settlements table (add taxpayer_id column)
    await db.schema.table('settlements', (table) => {
      table.integer('taxpayer_id').unsigned();
      table.foreign('taxpayer_id').references('taxpayers.id');
    });
 
    await db.schema.raw(addTaxpayerID);
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
