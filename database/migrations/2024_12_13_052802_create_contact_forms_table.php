<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('contact_forms', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('surname');
            $table->string('email');
            $table->string('phone');
            $table->text('message');
            $table->boolean('status')->default(0); // Okundu/Okunmadı durumu için
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('contact_forms');
    }
};