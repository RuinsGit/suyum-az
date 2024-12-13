<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            
            // Ana resim
            $table->string('image')->nullable();
            
            // İsim - çoklu dil
            $table->string('name_az')->nullable();
            $table->string('name_en')->nullable();
            $table->string('name_ru')->nullable();
            
            // Slug - çoklu dil
            $table->string('slug_az')->nullable();
            $table->string('slug_en')->nullable();
            $table->string('slug_ru')->nullable();
            
            // Text 1 - çoklu dil
            $table->text('text1_az')->nullable();
            $table->text('text1_en')->nullable();
            $table->text('text1_ru')->nullable();
            
            // Text 2 - çoklu dil
            $table->text('text2_az')->nullable();
            $table->text('text2_en')->nullable();
            $table->text('text2_ru')->nullable();
            
            // Description 1 - çoklu dil
            $table->text('description1_az')->nullable();
            $table->text('description1_en')->nullable();
            $table->text('description1_ru')->nullable();
            
            // Description 2 - çoklu dil
            $table->text('description2_az')->nullable();
            $table->text('description2_en')->nullable();
            $table->text('description2_ru')->nullable();
            
            // Alt resimler - JSON olarak saklayacağız
            $table->json('bottom_images')->nullable();
            
            $table->boolean('status')->default(1);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('projects');
    }
};