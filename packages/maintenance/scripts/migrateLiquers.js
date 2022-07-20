const knex = require('knex');
const datefns = require('date-fns')

const selectLiquersQuery = `
    SELECT
        DISTINCT ON (contribuyente.rif)
        contribuyente.rif,
        contribuyente.razonsocialdenominacioncomercial AS razonsocial,
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
    WHERE numlicencia IS NOT NULL
        AND fechavencimiento IS NOT NULL
        AND fechasolicitud IS NOT NULL
        AND horarioexp IS NOT NULL;
`;

const selectMobileLiqueurs = `
    SELECT
        DISTINCT ON (contribuyente.rif)
        contribuyente.rif,
        expendiosmoviles.expendios_id AS liqueur_id
    FROM public.expendios
    JOIN contribuyente
        ON contribuyente.id = expendios.contribuyente_id
    JOIN expendiosmoviles
        ON expendios.id = expendiosmoviles.expendios_id;
`

async function main() {
    const saucoDB = knex(require("../knexfile"));
    const recaudoDB = knex(require("../previousDBKnexfile"));

    try {
        let results = await recaudoDB.schema.raw(selectLiquersQuery)
        let mobileLiqueursResults = await recaudoDB.schema.raw(selectMobileLiqueurs)
        const { rows: liqueurs } = results;
        const { rows: mobileLiqueurs } = mobileLiqueursResults

        let notFoundTaxpayers = 0;
        let notMigrated = 0;
        let totalMigrated = 0;
        let activeLiqueuers = 0;
        const todayDate = new Date();

        for (let i = 0; i < liqueurs.length; i++) {
            /**
             * Pasos:
             * 0. Seleccionar licencias (LISTO)
             * 1. Migrar correlativo
             * 2. Buscar ID del contribuyente (LISTO)
             * 3. Crear licencia asociada al contribuyente y correlativo
             *      -- Falta determinar el estado de la licencia (Activo o no) en base a la fecha de pago o ultima renovacion
             * 4. Crear expendio. (LISTO)
             * 5. Migrar anexos
             */
            const taxpayer = await saucoDB('taxpayers')
                .select('*')
                .where('rif', 'like', `%${liqueurs[i].rif.slice(2)}%`);

            if (!taxpayer.length) {
                notFoundTaxpayers += 1;
                console.log(`Contribuyente ${liqueurs[i].razonsocial} no existe en la plataforma SAUCO.`)
                continue;
            }

            const representation = await saucoDB('representations')
                .select('*')
                .where('taxpayer_id', taxpayer[0].id)

            if (!representation.length) {
                notMigrated += 1;
                console.log(`Contribuyente ${taxpayer[0].name} no tiene representante, por tanto, sin Licencia de Actividad Económica.`)
                continue;
            }

            const expirationDate = datefns.format(new Date(liqueurs[i].fechavencimiento), 'dd-MM-Y');
            const emissionDate = datefns.format(new Date(liqueurs[i].fechasolicitud), 'dd-MM-Y');
            const isActive = datefns.isAfter(new Date(liqueurs[i].fechavencimiento), todayDate)

            if (isActive) {
                activeLiqueuers += 1
            }

            const license = await saucoDB('licenses').insert({
                num: liqueurs[i].numlicencia,
                emission_date: emissionDate,
                expiration_date: expirationDate,
                ordinance_id: 6,
                active: isActive,
                correlative_id: 1,  // Debo crearlo o anularlo
                representation_id: representation[0].id,
                taxpayer_id: taxpayer[0].id,
                created_at: liqueurs[i].fecharegistro_at,
                updated_at: liqueurs[i].fecharegistro_at
            }).returning('*');

            const isMobile = await mobileLiqueurs.find(mobileLiqueur => mobileLiqueur.liqueur_id == liqueurs[i].id)

            await saucoDB('liqueurs').insert({
                work_hours: liqueurs[i].horarioexp,
                liqueur_parameter_id: liqueurs[i].expendiosparametros_id,
                liqueur_classification_id: liqueurs[i].expendiosclasificacion_id,
                license_id: license[0].id,
                created_at: liqueurs[i].fecharegistro_at,
                updated_at: liqueurs[i].fecharegistro_at,
                is_mobile: isMobile ? true : false
            });

            totalMigrated += 1;
            console.log(`...Expendio ${license[0].num} migrado...`);
        }

        console.log('\n');
        console.log(`Total de expendios para migrar: ${liqueurs.length}`);
        console.log(`Expendios migrados: ${totalMigrated}`);
        console.log(`Contribuyentes no encontrados: ${notFoundTaxpayers}`);
        console.log(`Contribuyentes con incongruencias: ${notMigrated}`);
        console.log(`Expendios activos: ${activeLiqueuers}`);
        console.log('\n');
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
