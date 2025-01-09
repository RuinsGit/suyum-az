<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('certificates', function (Blueprint $table) {
            $table->string('image_alt_az')->nullable()->after('image');
            $table->string('image_alt_en')->nullable()->after('image_alt_az');
            $table->string('image_alt_ru')->nullable()->after('image_alt_en');
        });
    }

    public function down()
    {
        Schema::table('certificates', function (Blueprint $table) {
            $table->dropColumn([
                'image_alt_az',
                'image_alt_en',
                'image_alt_ru'
            ]);
        });
    }
};