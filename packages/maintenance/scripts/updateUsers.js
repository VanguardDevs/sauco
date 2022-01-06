const knex = require('knex');

const setNamesTable = `
  UPDATE users
  SET
    full_name = CONCAT(users.first_name, ' ', users.surname)
`;

async function updateUsersTable() {
  const db = knex(require("../knexfile"));

  try {
    await db.schema.table('role_user', (table) => {
      table.string('model_type').nullable();
    });

    await db.schema.table('permissions', (table) => {
      table.string('guard_name').defaultsTo('web');
    });

    await db.schema.table('roles', (table) => {
      table.string('guard_name').defaultsTo('web');
    });

    await db.schema.table('users', (table) => {
      table.string('full_name').nullable();
    });

    await db.schema.raw(setNamesTable);

    await db.schema.table('users', table => {
      table.dropColumn('first_name');
      table.dropColumn('surname');
    });

    await db.schema.raw(
      `
      UPDATE role_user
      SET
        model_type = 'App\\Models\\User'
      `
    );
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
