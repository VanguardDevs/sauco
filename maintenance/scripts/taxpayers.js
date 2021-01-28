const knex = require('knex');

async function taxpayers() {
  const db = knex(require("../knexfile"));

  try {
    const rows = await db
      .table('taxpayers')
      .orderBy('created_at')
      .then(rows => {
        rows.forEach(row => console.log(row));
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
