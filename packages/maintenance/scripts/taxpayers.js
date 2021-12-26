const knex = require('knex');

const updateCompaniesQuery = `
  UPDATE companies
  SET
    rif = taxpayers.rif,
    address = taxpayers.address,
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

const insertTaxpayersQuery = `
  INSERT INTO taxpayers
    (name, rif, taxpayer_type_id, taxpayer_classification_id, phone, email, address, parish_id, community_id)
    SELECT
        CONCAT(people.first_name, ' ', people.second_name, ' ', people.surname, ' ', people.second_surname) AS name,
        CONCAT(people.document, '-0') AS rif,
        taxpayer_types.id AS taxpayer_type_id,
        1,
        people.phone AS phone,
        people.email AS email,
        people.address AS address,
        1,
        1
      FROM people
      JOIN citizenships
        ON citizenships.id = people.citizenship_id
      JOIN taxpayer_types
        ON taxpayer_types.correlative = citizenships.correlative
      WHERE people.deleted_at IS NULL;
`;

async function taxpayers() {
  const db = knex(require("../knexfile"));

  try {
    // Create municipalities
    await db.schema.createTable('states', (table) => {
      table.increments();
      table.string('name');
      table.string('code').unique();
      table.timestamps();
    });

    await db.schema.createTable('municipalities', (table) => {
      table.increments();
      table.string('name');
      table.string('code').unique();
      table.integer('state_id').unsigned();
      table.foreign('state_id').references('states.id');
      table.timestamps();
    });

    await db.schema.table('parishes', (table) => {
        table.string('code');
        table.integer('municipality_id').unsigned();
        table.foreign('municipality_id').references('municipalities.id');
    });

    // Rename table companies
    await db.schema.renameTable('commercial_denominations', 'companies');

    await db.schema.table('companies', (table) => {
      table.string('rif');
      table.string('picture').nullable();
      table.string('address');
      table.decimal('capital', 2);
      table.integer('num_workers');
      table.integer('community_id').unsigned();
      table.integer('parish_id').unsigned();
      table.foreign('community_id').references('communities.id');
      table.foreign('parish_id').references('parishes.id');
    });

    await db.schema.table('taxpayers', (table) => {
        table.renameColumn('fiscal_address', 'address')
        table.string('picture').nullable();
        table.setNullable('address')
        table.integer('parish_id').unsigned();
        table.foreign('parish_id').references('parishes.id');
    });

    await db.schema.raw(updateTaxpayersRifQuery);
    await db.schema.raw(updateCompaniesQuery);

    // Create companies
    await db.select(
        'taxpayers.name as name',
        'taxpayers.rif as rif',
        'taxpayers.address as address',
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

    await db.schema.table('representations', (table) => {
        table.integer('company_id').unsigned();
        table.foreign('company_id').references('companies.id');
    });

    // create taxpayers from people table
    await db.schema.raw(insertTaxpayersQuery);

    /**
     *  FALTA
     *  Asociar contribuyente con empresa, a través de la relación representante
     *  Asociar empresas con actividades económicas
     *  Asociar empresas con facturas
     *  Asociar empresas con liquidaciones
     *  Asociar empresas con declaraciones
     *  Asociar empresas con solicitudes
     *  Asociar empresas con sanciones
     *  Asociar empresas con movimientos
     */

    // Clean up
    await db.schema.table('representations', (table) => {
        table.dropColumn('people_id');
    });
    await db.schema.dropTable('people');
    await db.schema.dropTable('permits');
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
