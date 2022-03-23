const knex = require('knex');

async function main() {
  const db = knex(require("../knexfile"));

  try {
    await db.schema.table('payments', (table) => {
      table.boolean('type').defaultTo(false);
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

module.exports = main;
