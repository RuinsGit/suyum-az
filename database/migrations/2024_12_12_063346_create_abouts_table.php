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
            $table->string('title_az')->default('');  // Default değer ekledik
            $table->string('title_en')->default('');  // Default değer ekledik
            $table->string('title_ru')->default('');  // Default değer ekledik
            $table->text('description_az')->nullable();  // Nullable yaptık
            $table->text('description_en')->nullable();  // Nullable yaptık
            $table->text('description_ru')->nullable();  // Nullable yaptık
            $table->string('video')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('abouts');
    }
};