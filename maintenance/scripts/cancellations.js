const knex = require('knex');

async function main() {
  const db = knex(require("../knexfile"));

  try {
    await db.schema.raw(
      `
      INSERT INTO cancellations
        (reason, cancellable_type, cancellable_id, user_id, cancellation_type_id, created_at, updated_at)
      SELECT 
        reason, 'App\\Models\\Payment', payment_id, user_id, 4, created_at, updated_at
      FROM null_payments
      `
    );

    await db.schema.raw(
      `
      INSERT INTO cancellations
        (reason, cancellable_type, cancellable_id, user_id, cancellation_type_id, created_at, updated_at)
      SELECT 
        reason, 'App\\Models\\Application', application_id, user_id, 1, created_at, updated_at
      FROM null_applications
      `
    );

    await db.schema.raw(
      `
      INSERT INTO cancellations
        (reason, cancellable_type, cancellable_id, user_id, cancellation_type_id, created_at, updated_at)
      SELECT 
        reason, 'App\\Models\\Fine', fine_id, user_id, 2, created_at, updated_at
      FROM null_fines
      `
    );

    await db.schema.raw(
      `
      INSERT INTO cancellations
        (reason, cancellable_type, cancellable_id, user_id, cancellation_type_id, created_at, updated_at)
      SELECT 
        reason, 'App\\Models\\Deduction', deduction_id, user_id, 5, created_at, updated_at
      FROM canceled_deductions
      `
    );

    await db.schema.raw(
      `
      INSERT INTO cancellations
        (reason, cancellable_type, cancellable_id, user_id, cancellation_type_id, created_at, updated_at)
      SELECT 
        reason, 'App\\Models\\Affidavit', affidavit_id, user_id, 3, created_at, updated_at
      FROM null_affidavits
      `
    );

    await db.schema.dropTable('null_affidavits');
    await db.schema.dropTable('null_fines');
    await db.schema.dropTable('null_applications');
    await db.schema.dropTable('null_payments');
    await db.schema.dropTable('canceled_deductions');
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
