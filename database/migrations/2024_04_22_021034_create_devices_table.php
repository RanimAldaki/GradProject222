<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('devices', function (Blueprint $table) {
            $table->id();
            $table->string('name');
<<<<<<< HEAD
            $table->string('description');
            $table->string('image');
            $table->integer('min_current');
            $table->integer('max_current');
            $table->integer('start_current');
=======
            $table->text('image');
            $table->double('powerWatt');
>>>>>>> 70f0be320d1ad5a027774f1914d8b0d973d3b823
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('devices');
    }
};
