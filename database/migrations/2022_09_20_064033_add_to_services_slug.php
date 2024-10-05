<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Service;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $services = Service::create(['name' => 'General Practioner']);
        $services->slug = 'general-practioner-services';
        $services->save();

        $services = Service::create(['name' => 'Dental']);
        $services->slug = 'dental-services';
        $services->save();

        $services = Service::create(['name' => 'Pediatric']);
        $services->slug = 'pediatric-services';
        $services->save();

        $services = Service::create(['name' => 'Dermatologist']);
        $services->slug = 'dermatologist-services';
        $services->save();

        $services = Service::create(['name' => 'Obstetrics and Gynecology']);
        $services->slug = 'general-practioner-services';
        $services->save();

        $services = Service::create(['name' => 'Hair Removel']);
        $services->slug = 'hair-removel-services';
        $services->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        service::where('slug', 'general-practioner-services')->delete();
        service::where('slug', 'dental-services')->delete();
        service::where('slug', 'pediatric-services')->delete();
        service::where('slug', 'dermatologist-services')->delete();
        service::where('slug', 'obstetrics-and-gynecology-services')->delete();
        service::where('slug', 'hair-removel-services')->delete();
    }
};
