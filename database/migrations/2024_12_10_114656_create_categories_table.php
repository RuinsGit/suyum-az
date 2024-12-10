<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name_az');
            $table->string('name_en');
            $table->string('name_ru');
            $table->text('description_az')->nullable();
            $table->text('description_en')->nullable();
            $table->text('description_ru')->nullable();
            $table->string('image')->nullable();
            $table->boolean('status')->default(1);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('categories');
    }
};