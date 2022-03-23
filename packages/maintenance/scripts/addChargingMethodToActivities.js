const knex = require('knex');

async function main() {
  const db = knex(require("../knexfile"));

  try {
    await db.schema.table('economic_activities', (table) => {
      table.integer('charging_method_id').unsigned();
      table.foreign('charging_method_id').references('charging_methods.id');
    });

    await db.schema.raw(
      `
      UPDATE economic_activities
      SET
        charging_method_id = 1
    `);
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
