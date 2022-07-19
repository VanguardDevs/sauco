const knex = require('knex');

const selectLiquersQuery = `
    SELECT
        contribuyente.rif,
        numlicencia,
        fechasolicitud,
        fechavencimiento,
        expendiosanexoa_id,
        expendiosclasificacion_id,
        expendiosparametros_id,
        explicstatus_id,
        horarioexp,
        fecharegistro_at,
        licenciaestatus_id,
        renovado,
        expendiosreferencia_id,
        fecharegistro
    FROM public.expendios
    JOIN contribuyente
    ON contribuyente.id = expendios.contribuyente_id
    WHERE numlicencia IS NOT NULL;
`;

async function main() {
    const saucoDB = knex(require("../knexfile"));
    const recaudoDB = knex(require("../previousDBKnexfile"));

    try {
        let results = await recaudoDB.schema.raw(selectLiquersQuery)
        const { rows } = results;

        for (let i = 0; i < rows.length; i++) {
            /**
             * Pasos:
             *
             * 1. Migrar correlativo
             * 2. Buscar ID del contribuyente
             * 3. Crear licencia asociada al contribuyente y correlativo
             *      -- Falta determinar el estado de la licencia (Activo o no) en base a la fecha de pago o ultima renovacion
             * 4. Crear expendio.
             */
            const license = await saucoDB('licenses').insert({
                num: rows[i].numlicencia,
                emission_date: rows[i].fechasolicitud,
                expiration_date: rows[i].fechavencimiento,
                ordinance_id: 6,
                correlative_id: 1,  // Debo crearlo
                taxpayer_id: 1,     // Hay que buscarlo
                created_at: rows[i].fecharegistro_at,
                updated_at: rows[i].fecharegistro_at
            }).returning('*');

            await saucoDB('liqueurs').insert({
                work_hours: rows[i].horarioexp,
                liqueur_parameter_id: rows[i].expendiosparametros_id,
                liqueur_classification_id: rows[i].expendiosclasificacion_id,
                license_id: license[0].id,
                created_at: rows[i].fecharegistro_at,
                updated_at: rows[i].fecharegistro_at
            });

            console.log(`...Expendio ${license[0].num} migrado...`);
        }
    } finally {
        await recaudoDB.destroy();
        await saucoDB.destroy();
    }
}

if (!module.parent) {
    main().catch((err) => {
        console.error(err);
        process.exit(1);
    });
}

module.exports = main;
