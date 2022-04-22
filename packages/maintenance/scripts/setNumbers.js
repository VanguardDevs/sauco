/**
 * Set numbers for all records in tables fines, applications and affidavits
 */

const knex = require('knex');

// Get number
const getNumber = iter => ('00000000' + (iter + 1).toString())
    .slice(-8)

const updateQuery = (table, id, number) => (`
    UPDATE ${table}
    SET num = '${number}'
    WHERE id = ${id}
`)

const tables = ['applications', 'fines', 'affidavits'];

async function setNumbers() {
  const db = knex(require("../knexfile"));

    try {
        try {
            await tables.forEach(async (relation) => {
                await db.schema.table(relation, (table) => {
                    table.string('num', 8).nullable();
                });
            })
        } catch (e) {
            console.log(e)
        }

        // Update permissions table
        await db.schema.table('permission_user', (table) => {
            table.string('model_type');
        });

        // Set avatar for all users;
        await db.schema.raw(`
            UPDATE users
            SET avatar = 'default/user.png'
        `)

        // Set numbers for affidavits
        await db.select('*').from('affidavits')
            .whereNotNull('affidavits.processed_at')
            .orderBy('processed_at', 'ASC')
            .then(async rows => {
                for (let i = 0; i < rows.length + 1; i++) {
                    if (rows[i] != undefined) {
                        const { id } = rows[i]
                        const number = await getNumber(i);

                        await db.schema.raw(updateQuery('affidavits', id, number))

                        console.log(`..Affidavit ${id} updated (${number})...`)
                    }
                }
            });

        await db.select('*').from('fines')
            .orderBy('updated_at', 'ASC')
            .then(async rows => {
                for (let i = 0; i < rows.length + 1; i++) {
                    if (rows[i] != undefined) {
                        const { id } = rows[i]
                        const number = await getNumber(i);

                        await db.schema.raw(updateQuery('fines', id, number))

                        console.log(`..Fine ${id} updated (${number})...`)
                    }
                }
            });

        await db.select('*').from('applications')
            .orderBy('updated_at', 'ASC')
            .then(async rows => {
                for (let i = 0; i < rows.length + 1; i++) {
                    if (rows[i] != undefined) {
                        const { id } = rows[i]
                        const number = await getNumber(i);

                        await db.schema.raw(updateQuery('applications', id, number))

                        console.log(`..Application ${id} updated (${number})...`)
                    }
                }
            });

    } finally {
        await db.destroy();
    }
}

if (!module.parent) {
    setNumbers().catch((err) => {
        console.error(err);
        process.exit(1);
    });
}

module.exports = setNumbers;
