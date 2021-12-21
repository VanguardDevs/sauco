const knex = require('knex');

async function main() {
  const db = knex(require("../knexfile"));

  try {

    await db.schema.table('economic_activities', (table) => {
      table.boolean('active').defaultTo(true);
      table.dropForeign('activity_classification_id');
      table.dropColumn('activity_classification_id');
    });

    await db.schema.raw(
      `
      UPDATE economic_activities
      SET
        active = false
      WHERE id IS NOT NULL
      `
    );

    await db.schema.raw(
      `
        ALTER TABLE concepts
        ALTER COLUMN code
        TYPE VARCHAR(20)
      `
    );

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
