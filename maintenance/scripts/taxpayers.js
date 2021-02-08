const knex = require('knex');

async function taxpayers() {
  const db = knex(require("../knexfile"));

  try {
    // Rename table companies
    await db.schema.renameTable('commercial_denominations', 'companies');

    await db.schema.table('companies', (table) => {
      table.string('address');
      table.decimal('capital', 2);
      table.integer('num_workers');
    });

    const taxpayers = await db.select(
        'taxpayers.name as name', 
        'taxpayers.fiscal_address as address',
        'taxpayers.id as taxpayer_id',
        'taxpayers.created_at as created_at',
        'taxpayers.updated_at as updated_at',
        'taxpayers.deleted_at as deleted_at'
      ).from('taxpayers')
      .leftJoin('companies', 'taxpayers.id', 'companies.taxpayer_id')
      .whereNull('companies.taxpayer_id')
      .then(async rows => {
        await db('companies').insert(rows);

        console.log(`Created ${rows.length} companies`)
      });
  } finally {
    await db.destroy();
  }
}

if (!module.parent) {
  taxpayers().catch((err) => {
    console.error(err);
    process.exit(1);
  });
}

module.exports = taxpayers;
