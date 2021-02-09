const knex = require('knex');

const updateCompaniesQuery = `
  UPDATE companies 
  SET 
    address = taxpayers.fiscal_address,
    community_id = taxpayers.community_id,
    parish_id = 1
  FROM taxpayers WHERE taxpayers.id = companies.taxpayer_id
`;

const updateTaxpayersRifQuery = `
  UPDATE taxpayers
  SET
    rif = subquery.rif
  FROM (
    SELECT 
      CONCAT(taxpayer_types.correlative, taxpayers.rif) AS rif, 
      taxpayers.id 
    FROM taxpayers 
      JOIN taxpayer_types 
      ON taxpayers.taxpayer_type_id = taxpayer_types.id
    )
  AS subquery
  WHERE taxpayers.id = subquery.id
`;

async function taxpayers() {
  const db = knex(require("../knexfile"));

  try {
    // Rename table companies
    await db.schema.renameTable('commercial_denominations', 'companies');

    await db.schema.table('companies', (table) => {
      table.string('rif');
      table.string('address');
      table.decimal('capital', 2);
      table.integer('num_workers');
      table.integer('community_id').unsigned();
      table.integer('parish_id').unsigned();
      table.foreign('community_id').references('communities.id');
      table.foreign('parish_id').references('parishes.id');
    });
    
    const updateCompanies = await db.schema.raw(updateCompaniesQuery);
    const updateTaxpayersRif = await db.schema.raw(updateTaxpayersRifQuery);

    // Create companies
    const taxpayers = await db.select(
        'taxpayers.name as name', 
        'taxpayers.rif as rif', 
        'taxpayers.fiscal_address as address',
        'taxpayers.id as taxpayer_id',
        'taxpayers.community_id as community_id',
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
