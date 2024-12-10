<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            
            // Çoklu dil alanları
            $table->string('name_az');
            $table->string('name_en');
            $table->string('name_ru');
            $table->string('cartridge_az')->nullable();
            $table->string('cartridge_en')->nullable();
            $table->string('cartridge_ru')->nullable();
            $table->string('pressure_range_az')->nullable();
            $table->string('pressure_range_en')->nullable();
            $table->string('pressure_range_ru')->nullable();
            $table->string('temperature_range_az')->nullable();
            $table->string('temperature_range_en')->nullable();
            $table->string('temperature_range_ru')->nullable();
            $table->string('dimensions_az')->nullable();
            $table->string('dimensions_en')->nullable();
            $table->string('dimensions_ru')->nullable();
            $table->string('warranty_az')->nullable();
            $table->string('warranty_en')->nullable();
            $table->string('warranty_ru')->nullable();
            $table->string('country_az')->nullable();
            $table->string('country_en')->nullable();
            $table->string('country_ru')->nullable();
    
            // Fiyat ve taksit bilgileri
            $table->decimal('price', 10, 2);
            $table->decimal('annual_percentage', 5, 2)->default(0);
            $table->string('installment_months')->nullable();
    
            // Kurye ve kurulum
            $table->boolean('has_courier')->default(false);
            $table->decimal('courier_price', 10, 2)->nullable();
            $table->boolean('has_installation')->default(false);
            $table->decimal('installation_price', 10, 2)->nullable();
    
            // Resimler
            $table->string('main_image');
            $table->string('courier_image')->nullable();
            $table->string('installation_image')->nullable();
            $table->string('payment_image_1')->nullable();
            $table->string('payment_image_2')->nullable();
    
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('products');
    }
};