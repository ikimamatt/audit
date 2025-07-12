<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('master_user', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nama');
            $table->string('nip');
            $table->unsignedBigInteger('master_akses_user_id');
            $table->timestamps();

            $table->foreign('master_akses_user_id')->references('id')->on('master_akses_user')->onDelete('restrict');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('master_user');
    }
}; 