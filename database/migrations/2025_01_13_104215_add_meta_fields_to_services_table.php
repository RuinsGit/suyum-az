<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('services', function (Blueprint $table) {
            $table->string('meta_title_az')->nullable();
            $table->string('meta_title_en')->nullable();
            $table->string('meta_title_ru')->nullable();
            $table->text('meta_description_az')->nullable();
            $table->text('meta_description_en')->nullable();
            $table->text('meta_description_ru')->nullable();
        });
    }
    
    public function down()
    {
        Schema::table('services', function (Blueprint $table) {
            $table->dropColumn([
                'meta_title_az',
                'meta_title_en',
                'meta_title_ru',
                'meta_description_az',
                'meta_description_en',
                'meta_description_ru'
            ]);
        });
    }
};
