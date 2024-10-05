<?php

use App\Models\Banner;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $banner = Banner::create(['name' => 'Contact Us', 'multiple' => 0, 'is_deletable' => 0]);
        $banner->slug = 'contact-banner';
        $banner->save();

        $banner = Banner::create(['name' => 'About Us', 'multiple' => 0, 'is_deletable' => 0]);
        $banner->slug = 'aboutus-banner';
        $banner->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Banner::where('slug', 'contact-banner')->delete();
        Banner::where('slug', 'aboutus-banner')->delete();
    }
};