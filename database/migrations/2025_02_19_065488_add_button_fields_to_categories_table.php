<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->string('button_image')->nullable()->after('image');
            $table->string('button_image_alt_az')->nullable()->after('button_image');
            $table->string('button_image_alt_en')->nullable()->after('button_image_alt_az');
            $table->string('button_image_alt_ru')->nullable()->after('button_image_alt_en');
        });
    }

    public function down()
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->dropColumn('button_image');
            $table->dropColumn('button_image_alt_az');
            $table->dropColumn('button_image_alt_en');
            $table->dropColumn('button_image_alt_ru');
        });
    }
}; 