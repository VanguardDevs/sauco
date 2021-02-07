const knex = require('knex');

async function taxpayers() {
  const db = knex(require("../knexfile"));

  try {
    // Rename table companies
    await db.schema.renameTable('commercial_denominations', 'companies');
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
