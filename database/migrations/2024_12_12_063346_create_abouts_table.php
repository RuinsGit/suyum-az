<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('abouts', function (Blueprint $table) {
            $table->id();
            $table->string('title_az')->default('');
            $table->string('title_en')->default('');
            $table->string('title_ru')->default('');
            $table->text('description_az')->nullable();
            $table->text('description_en')->nullable();
            $table->text('description_ru')->nullable();  
            $table->string('video')->nullable();
            $table->timestamps();
        }); 
    }

    public function down()
    {
        Schema::dropIfExists('abouts');
    }
};