#!/bin/bash
php artisan migrate --path=database/migrations/2021_09_16_170928_create_items_table.php
php artisan migrate --path=database/migrations/2021_09_17_084136_create_cubicles_table.php
php artisan migrate --path=database/migrations/2022_07_17_092631_create_colors_table.php
php artisan migrate --path=database/migrations/2022_07_17_092637_create_brands_table.php
php artisan migrate --path=database/migrations/2022_07_17_092720_create_vehicle_models_table.php
php artisan migrate --path=database/migrations/2022_07_17_102918_create_vehicle_parameters_table.php
php artisan migrate --path=database/migrations/2022_07_17_113350_create_vehicle_classifications_table.php
php artisan migrate --path=database/migrations/2022_07_17_113515_create_vehicles_table.php
php artisan db:seed --class=BrandTableSeeder
php artisan db:seed --class=VehicleModelTableSeeder
php artisan db:seed --class=VehicleParameterSeeder
php artisan db:seed --class=ColorsTableSeeder
