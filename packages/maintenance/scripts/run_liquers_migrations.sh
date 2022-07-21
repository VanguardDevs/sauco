#!/bin/bash
php artisan migrate --path=database/migrations/2022_03_14_105733_create_liqueur_zones_table.php
php artisan migrate --path=database/migrations/2022_03_14_105848_create_liqueur_classifications_table.php
php artisan migrate --path=database/migrations/2022_03_14_110218_create_liqueur_parameters_table.php
php artisan migrate --path=database/migrations/2022_03_14_111011_create_liqueurs_table.php
php artisan migrate --path=database/migrations/2022_03_16_101401_create_annexed_liqueurs_table.php
php artisan migrate --path=database/migrations/2022_03_16_101744_create_liqueur_annexes_table.php
php artisan migrate --path=database/migrations/2022_06_14_105831_create_liqueur_liquidation_table.php
php artisan migrate --path=database/migrations/2022_06_16_202120_create_requirements_table.php
php artisan migrate --path=database/migrations/2022_07_20_161136_create_leased_liqueurs_table.php
php artisan db:seed --class=LiqueurAnnexSeeder
php artisan db:seed --class=LiqueurClassificationSeeder
php artisan db:seed --class=LiqueurZoneSeeder
php artisan db:seed --class=LiqueurParameterSeeder
php artisan db:seed --class=RequirementsTableSeeder
cd packages/maintenance
npm run migrateLiqueurs
