<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('contacts', function (Blueprint $table) {
            $table->string('filial_name_az')->nullable();
            $table->string('filial_name_en')->nullable();
            $table->string('filial_name_ru')->nullable();
        });
    }

    public function down()
    {
        Schema::table('contacts', function (Blueprint $table) {
            $table->dropColumn(['filial_name_az', 'filial_name_en', 'filial_name_ru']);
        });
    }
}; 