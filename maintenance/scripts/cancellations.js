const knex = require('knex');

async function main() {
  const db = knex(require("../knexfile"));

  try {
    /**
     * Create tables
     */
    await db.schema.createTable('cancellations', (table) => {
      table.increments();
      table.string('reason');
      table.string('cancellable_type');
      table.integer('cancellable_id').unsigned();
      table.integer('user_id').unsigned();
      table.timestamps();
      table.timestamp('deleted_at').nullable();
      table.foreign('user_id').references('users.id');
    });

    await db.schema.raw(
      `
      INSERT INTO cancellations
        (reason, cancellable_type, cancellable_id, user_id, created_at, updated_at)
      SELECT 
        reason, 'App\\Models\\Payment', payment_id, user_id, created_at, updated_at
      FROM null_payments
      `
    );

    await db.schema.raw(
      `
      INSERT INTO cancellations
        (reason, cancellable_type, cancellable_id, user_id, created_at, updated_at)
      SELECT 
        reason, 'App\\Models\\Application', application_id, user_id, created_at, updated_at
      FROM null_applications
      `
    );

    await db.schema.raw(
      `
      INSERT INTO cancellations
        (reason, cancellable_type, cancellable_id, user_id, created_at, updated_at)
      SELECT 
        reason, 'App\\Models\\Fine', fine_id, user_id, created_at, updated_at
      FROM null_fines
      `
    );

    await db.schema.raw(
      `
      INSERT INTO cancellations
        (reason, cancellable_type, cancellable_id, user_id, created_at, updated_at)
      SELECT 
        reason, 'App\\Models\\Deduction', deduction_id, user_id, created_at, updated_at
      FROM canceled_deductions
      `
    );

    await db.schema.raw(
      `
      INSERT INTO cancellations
        (reason, cancellable_type, cancellable_id, user_id, created_at, updated_at)
      SELECT 
        reason, 'App\\Models\\Affidavit', affidavit_id, user_id, created_at, updated_at
      FROM null_affidavits
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
