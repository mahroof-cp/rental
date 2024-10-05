<?php

use App\Models\CmsCategory;
use App\Models\CmsPage;
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
        CmsPage::create(['name' => 'About Us', 'title' => 'About Us', 'is_deletable' => 0]);
        CmsPage::create(['name' => 'Our Mission', 'title' => 'Our Mission', 'is_deletable' => 0]);
        CmsPage::create(['name' => 'Our Vision', 'title' => 'Our Vision', 'is_deletable' => 0]);

        CmsCategory::create(['name' => 'Testimonials']);
        CmsCategory::create(['name' => 'Why Choose Us']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        CmsPage::where('slug', 'about_us')->forceDelete();
        CmsPage::where('slug', 'our_mission')->forceDelete();
        CmsPage::where('slug', 'our_vision')->forceDelete();

        CmsCategory::where('slug', 'testimonials')->forceDelete();
        CmsCategory::where('slug', 'why_choose_us')->forceDelete();
    }
};