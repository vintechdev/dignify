<?php

Route::get('migrate', function () {
    error_reporting(E_ALL);
    try {
       // Illuminate\Support\Facades\DB::statement("alter table typicms_brochures add column title varchar(500) default null");
       // Illuminate\Support\Facades\DB::statement("alter table typicms_brochure_details add column file_path varchar(500) default null");
	   // Illuminate\Support\Facades\DB::statement("alter table typicms_brochures add column file_url varchar(500) default null");
	   //Illuminate\Support\Facades\DB::statement("alter table typicms_brochures add column url varchar(1000) default null");
        Illuminate\Support\Facades\DB::statement("alter table typicms_products add column finishing_type varchar(255) default null");

    } catch (Exception $e) {
        return $e;
    }
});

Route::get('storage-link', function () {
    try {
        \Illuminate\Support\Facades\Artisan::call('storage:link');
    } catch (Exception $e) {
        return $e;
    }

});
