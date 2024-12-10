<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('headers', function (Blueprint $table) {
            $table->id();
            // Ana Səhifə
            $table->string('home_az')->nullable();
            $table->string('home_en')->nullable();
            $table->string('home_ru')->nullable();
            
            // Haqqımızda
            $table->string('about_az')->nullable();
            $table->string('about_en')->nullable();
            $table->string('about_ru')->nullable();
            
            // Məhsullar
            $table->string('products_az')->nullable();
            $table->string('products_en')->nullable();
            $table->string('products_ru')->nullable();
            
            // Xidmətlər
            $table->string('services_az')->nullable();
            $table->string('services_en')->nullable();
            $table->string('services_ru')->nullable();
            
            // Layihələr
            $table->string('projects_az')->nullable();
            $table->string('projects_en')->nullable();
            $table->string('projects_ru')->nullable();
            
            // Sertifikatlar
            $table->string('certificates_az')->nullable();
            $table->string('certificates_en')->nullable();
            $table->string('certificates_ru')->nullable();
            
            // Müştərilər
            $table->string('customers_az')->nullable();
            $table->string('customers_en')->nullable();
            $table->string('customers_ru')->nullable();
            
            // Əlaqə
            $table->string('contact_az')->nullable();
            $table->string('contact_en')->nullable();
            $table->string('contact_ru')->nullable();
            
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('headers');
    }
};