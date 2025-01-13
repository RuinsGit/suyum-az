<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            // Meta Title alanları
            $table->string('main_image_meta_title_az')->nullable();
            $table->string('main_image_meta_title_en')->nullable();
            $table->string('main_image_meta_title_ru')->nullable();
            
            // Meta Description alanları
            $table->text('main_image_meta_description_az')->nullable();
            $table->text('main_image_meta_description_en')->nullable();
            $table->text('main_image_meta_description_ru')->nullable();
        });
    }

    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn([
                'main_image_meta_title_az',
                'main_image_meta_title_en',
                'main_image_meta_title_ru',
                'main_image_meta_description_az',
                'main_image_meta_description_en',
                'main_image_meta_description_ru'
            ]);
        });
    }
};