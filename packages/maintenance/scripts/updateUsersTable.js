const knex = require('knex');

async function updateUsersTable() {
  const db = knex(require("../knexfile"));

  try {
    await db.schema.table('users', (table) => {
      table.boolean('active').defaultTo(true);
    });
  } finally {
    await db.destroy();
  }
}

if (!module.parent) {
  updateUsersTable().catch((err) => {
    console.error(err);
    process.exit(1);
  });
}

module.exports = updateUsersTable;
