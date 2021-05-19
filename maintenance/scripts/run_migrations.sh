#!/bin/bash
cd ../core/backend
php artisan migrate --path=database/migrations/2021_05_03_110812_create_cancellation_types_table.php
php artisan migrate --path=database/migrations/2021_05_03_125539_create_cancellations_table.php
php artisan migrate --path=database/migrations/2021_01_29_112717_create_affidavit_fine_table.php
php artisan migrate --path=database/migrations/2021_05_18_061426_create_petro_prices_table.php
php artisan db:seed --class=CancellationTypesSeeder
cd ../../maintenance
npm run fineaffidavit
npm run liquidations
npm run deductions
npm run movements
npm run cancellations
