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

const setTaxpayerIdToMovementsTable = `
    UPDATE movements
    SET
        taxpayer_id = subquery.taxpayer_id
    FROM (
        SELECT
            id,
            taxpayer_id
        FROM payments
    )
    AS subquery
    WHERE movements.payment_id = subquery.id
`;

const setCompanyId = (tableName) => (`
    UPDATE ${tableName}
    SET
        company_id = subquery.id
    FROM (
        SELECT
            companies.id,
            taxpayer_id
        FROM taxpayers
        JOIN
            companies
            ON companies.taxpayer_id = taxpayers.id
    )
    AS subquery
    WHERE ${tableName}.taxpayer_id = subquery.taxpayer_id;
`);

const updateOwnableIdQuery = (tableName) => (`
    UPDATE ${tableName}
    SET
        ownable_type = 'company',
        ownable_id = subquery.id
    FROM (
    SELECT
        companies.id AS id,
        taxpayers.id AS taxpayer_id
    FROM taxpayers
        JOIN companies
        ON taxpayers.id = companies.taxpayer_id
    )
    AS subquery
    WHERE ${tableName}.taxpayer_id = subquery.taxpayer_id;
`);

const updateTaxpayerIdFromRepresentations = `
    UPDATE representations
    SET
        taxpayer_id = subquery.id
    FROM (
        SELECT
            taxpayers.id,
            company_id
        FROM taxpayers
            JOIN people
                ON rif ILIKE '%' || people.document || '%'
            JOIN representations
                ON representations.person_id = people.id
    )
    AS subquery
    WHERE representations.company_id = subquery.company_id;
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

const ownableTables = ['applications', 'fines', 'liquidations', 'movements', 'payments', 'licenses'];
const companiesTables = ['representations', 'affidavits', 'economic_activity_taxpayer'];

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
      table.boolean('active').defaultsTo(true);
      table.boolean('principal').defaultsTo(true);
      table.date('constitution_date').nullable();
      table.string('register_num').nullable();
      table.string('register_volume').nullable();
      table.string('register_casefile').nullable();
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

    await db.schema.table('affidavits', (table) => {
        table.string('num').nullable();
        table.integer('company_id').unsigned();
        table.foreign('company_id').references('companies.id');
    });

    await db.schema.table('economic_activity_taxpayer', (table) => {
        table.integer('company_id').unsigned();
        table.foreign('company_id').references('companies.id');
    });

    // create taxpayers from people table
    await db.schema.raw(insertTaxpayersQuery);

    // Set taxpayer_id column for movements table
    await db.schema.table('movements', (table) => {
        table.integer('taxpayer_id').unsigned();
        table.foreign('taxpayer_id').references('taxpayers.id');
    });

    // Set taxpayer_id to movements
    await db.schema.raw(setTaxpayerIdToMovementsTable);

    // Associate existing records with companies
    await ownableTables.forEach(async (relation) => {
        await db.schema.table(relation, (table) => {
            table.string('ownable_type').nullable();
            table.integer('ownable_id').nullable();
        });

        await db.schema.raw(updateOwnableIdQuery(relation));
    })

    // Set company id to affidavits and representations
    await companiesTables.forEach(async (relation) => {
        await db.schema.raw(setCompanyId(relation));
    })

    // Clean up
    await db.schema.renameTable('economic_activity_taxpayer', 'economic_activity_company');

    await db.schema.raw(updateTaxpayerIdFromRepresentations);

    await db.schema.table('affidavits', (table) => {
        table.dropColumn('taxpayer_id');
    });
    await db.schema.table('economic_activity_company', (table) => {
        table.dropColumn('taxpayer_id');
    });
    await db.schema.table('representations', (table) => {
        table.dropColumn('person_id');
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
