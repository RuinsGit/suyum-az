<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('translations', function (Blueprint $table) {
            $table->id();
            
            // Logo
            $table->string('logo')->nullable();
            
            // Text 1 - çoklu dil
            $table->text('text1_az')->nullable();
            $table->text('text1_en')->nullable();
            $table->text('text1_ru')->nullable();
            
            // Text 2 - çoklu dil
            $table->text('text2_az')->nullable();
            $table->text('text2_en')->nullable();
            $table->text('text2_ru')->nullable();
            
            // Text 3 - çoklu dil
            $table->text('text3_az')->nullable();
            $table->text('text3_en')->nullable();
            $table->text('text3_ru')->nullable();
            
            // Text 4 - çoklu dil
            $table->text('text4_az')->nullable();
            $table->text('text4_en')->nullable();
            $table->text('text4_ru')->nullable();
            
            // Text 5 - çoklu dil
            $table->text('text5_az')->nullable();
            $table->text('text5_en')->nullable();
            $table->text('text5_ru')->nullable();
            
            // Text 6 - çoklu dil
            $table->text('text6_az')->nullable();
            $table->text('text6_en')->nullable();
            $table->text('text6_ru')->nullable();
            
            // Text 7 - çoklu dil
            $table->text('text7_az')->nullable();
            $table->text('text7_en')->nullable();
            $table->text('text7_ru')->nullable();
            
            // Text 8 - çoklu dil
            $table->text('text8_az')->nullable();
            $table->text('text8_en')->nullable();
            $table->text('text8_ru')->nullable();
            
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('translations');
    }
};