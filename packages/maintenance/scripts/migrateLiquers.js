const knex = require('knex');
const datefns = require('date-fns')
const fs = require('fs');

const selectLiquersQuery = `
    SELECT
        DISTINCT ON (contribuyente_id, numlicencia)
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
        AND horarioexp IS NOT NULL
    ORDER BY contribuyente_id, numlicencia, fechasolicitud DESC;
`;

const selectLeasedLiquersQuery = `
    SELECT
        contribuyente.rif,
        expendiosarrendados.id,
        fechadesde,
        fechahasta,
        expendios.numlicencia
    FROM public.expendiosarrendados
        JOIN contribuyente ON contribuyente.id = expendiosarrendados.arrendador
        JOIN expendios ON expendios.id = expendiosarrendados.expendios_id;
`;

const selectAnnexesQuery = `
    SELECT DISTINCT ON (numlicencia) numlicencia, anexo_id
        FROM public.expendio_anexos
        JOIN expendios ON expendios.id = expendio_id;
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

const buildLine = (taxpayer, rif, numlicencia, date1, date2) => (`${taxpayer},${rif},${numlicencia},${date1},${date2}\n`)

async function main() {
    const saucoDB = knex(require("../knexfile"));
    const recaudoDB = knex(require("../previousDBKnexfile"));

    try {
        let allResults = await recaudoDB.schema.raw(selectLiquersQuery)
        let mobileLiqueursResults = await recaudoDB.schema.raw(selectMobileLiqueurs)
        const { rows: liqueurs } = allResults;
        const { rows: mobileLiqueurs } = mobileLiqueursResults

        let notFoundTaxpayers = 0;
        let notMigrated = 0;
        let totalMigrated = 0;
        let activeLiqueuers = 0;
        let leasedLiqueursMigrated = 0;
        let todayDate = new Date();
        let annexMigrated = 0;
        let notMigratedList = [];
        let activeLiqueuersList = [];
        let inactiveLiqueuersList = [];

        for (let i = 0; i < liqueurs.length; i++) {
            const expirationDate = datefns.format(new Date(liqueurs[i].fechavencimiento), 'dd-MM-Y');
            const emissionDate = datefns.format(new Date(liqueurs[i].fechasolicitud), 'dd-MM-Y');

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
                notMigratedList.push(
                    buildLine(
                        taxpayer[0].name,
                        liqueurs[i].rif,
                        liqueurs[i].numlicencia,
                        emissionDate,
                        expirationDate
                    )
                )
                console.log(`Contribuyente ${taxpayer[0].name} no tiene representante, por tanto, sin Licencia de Actividad Económica.`)
                continue;
            }

            const isActive = datefns.isAfter(new Date(expirationDate), todayDate)

            if (isActive) {
                activeLiqueuers += 1
                activeLiqueuersList.push(
                    buildLine(
                        taxpayer[0].name,
                        liqueurs[i].rif,
                        liqueurs[i].numlicencia,
                        emissionDate,
                        expirationDate
                    )
                )
            } else {
                inactiveLiqueuersList.push(
                    buildLine(
                        taxpayer[0].name,
                        liqueurs[i].rif,
                        liqueurs[i].numlicencia,
                        emissionDate,
                        expirationDate
                    )
                )
            }

            const license = await saucoDB('licenses').insert({
                num: liqueurs[i].numlicencia,
                emission_date: emissionDate,
                expiration_date: expirationDate,
                ordinance_id: 6,
                active: isActive,
                correlative_id: 1,
                representation_id: representation[0].id,
                taxpayer_id: taxpayer[0].id,
                created_at: liqueurs[i].fecharegistro_at,
                updated_at: liqueurs[i].fecharegistro_at
            }).returning('*');

            const isMobile = await mobileLiqueurs.find(mobileLiqueur => mobileLiqueur.liqueur_id == liqueurs[i].id)

            await saucoDB('liqueurs').insert({
                num: liqueurs[i].numlicencia,
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

        console.log('\n\n...Migrando las licencias arrendadas...\n\n');

        let oldLeasedLiqueurs = await recaudoDB.schema.raw(selectLeasedLiquersQuery)
        const { rows: leasedLiqueursResults } = oldLeasedLiqueurs;

        for (let i = 0; i < leasedLiqueursResults.length; i++) {
            const mLiqueurLicense = await saucoDB('liqueurs')
                .select('num', 'id')
                .where('num', leasedLiqueursResults[i].numlicencia)
                .returning('*');

            if (!mLiqueurLicense.length) {
                console.log(`Expendio ${leasedLiqueursResults[i].numlicencia} no existe en la plataforma SAUCO.`)
                continue;
            }

            const taxpayer = await saucoDB('taxpayers')
                .select('*')
                .where('rif', 'like', `%${leasedLiqueursResults[i].rif.slice(2)}%`);

            if (!taxpayer.length) {
                console.log(`Contribuyente ${leasedLiqueursResults[i].rif} no existe en la plataforma SAUCO.`)
                continue;
            }

            await saucoDB('leased_liqueurs').insert({
                liqueur_id: mLiqueurLicense[0].id,
                leaser_id: taxpayer[0].id,
                since: leasedLiqueursResults[i].fechadesde,
                until: leasedLiqueursResults[i].fechahasta,
            });

            leasedLiqueursMigrated += 1;
            console.log(`...Expendio ${mLiqueurLicense[0].num} migrado...`);
        }

        console.log('\n\n...Migrando los anexos...\n\n');

        let oldLiqueurAnnexes = await recaudoDB.schema.raw(selectAnnexesQuery)
        const { rows: liqueurAnnexesResults } = oldLiqueurAnnexes;

        for (let i = 0; i < liqueurAnnexesResults.length; i++) {
            const newLicense = await saucoDB('liqueurs')
                .select('num', 'id')
                .where('num', liqueurAnnexesResults[i].numlicencia)
                .returning('*');

            if (!newLicense.length) {
                console.log(`Expendio ${liqueurAnnexesResults[i].numlicencia} no existe en la plataforma SAUCO.`)
                continue;
            }

            await saucoDB('liqueur_annexes').insert({
                liqueur_id: newLicense[0].id,
                annex_id: liqueurAnnexesResults[0].anexo_id
            });

            annexMigrated += 1;
            console.log(`...Expendio ${newLicense[0].num} migrado...`);
        }

        console.log('\n');
        console.log(`Total de expendios para migrar: ${liqueurs.length}`);
        console.log(`Expendios migrados: ${totalMigrated}`);
        console.log(`Contribuyentes no encontrados: ${notFoundTaxpayers}`);
        console.log(`Contribuyentes con incongruencias: ${notMigrated}`);
        console.log(`Expendios activos: ${activeLiqueuers}`);
        console.log(`Expendios arrendados migrados: ${leasedLiqueursMigrated}`);
        console.log(`Anexos migrados: ${annexMigrated}`);
        console.log('\n');

        /**
         * Write to disk
         */
        fs.writeFile('expendios_sin_LAE.txt', notMigratedList.join(''), (err) => {
            if (err) throw err;
            console.log('¡Expendios registrados!');
        });

        fs.writeFile('expendios_inactivos.txt', inactiveLiqueuersList.join(''), (err) => {
            if (err) throw err;
            console.log('¡Expendios inactivos registrados!');
        });

        fs.writeFile('expendios_activos.txt', activeLiqueuersList.join(''), (err) => {
            if (err) throw err;
            console.log('¡Expendios activos registrados!');
        });
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
