<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('services', function (Blueprint $table) {
            // Ana resim için ALT etiketleri
            $table->string('image_alt_az')->nullable()->after('image');
            $table->string('image_alt_en')->nullable()->after('image_alt_az');
            $table->string('image_alt_ru')->nullable()->after('image_alt_en');
            
            // Alt resim için ALT etiketleri
            $table->string('bottom_image_alt_az')->nullable()->after('bottom_image');
            $table->string('bottom_image_alt_en')->nullable()->after('bottom_image_alt_az');
            $table->string('bottom_image_alt_ru')->nullable()->after('bottom_image_alt_en');
        });
    }

    public function down()
    {
        Schema::table('services', function (Blueprint $table) {
            $table->dropColumn([
                'image_alt_az',
                'image_alt_en',
                'image_alt_ru',
                'bottom_image_alt_az',
                'bottom_image_alt_en',
                'bottom_image_alt_ru'
            ]);
        });
    }
};