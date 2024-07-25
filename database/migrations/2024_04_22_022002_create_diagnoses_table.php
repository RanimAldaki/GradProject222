<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('diagnoses', function (Blueprint $table) {
            $table->id();
            $table->text('desc');
<<<<<<< HEAD
            $table->integer('type_id');
            $table->date('date');
=======
>>>>>>> 70f0be320d1ad5a027774f1914d8b0d973d3b823
            $table->foreignId('record_id')->references('id')->on('records')->onDelete('cascade');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('diagnoses');
    }
};
