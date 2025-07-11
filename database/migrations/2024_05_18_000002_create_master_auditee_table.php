<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('master_auditee', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('direktorat');
            $table->string('divisi_cabang');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('master_auditee');
    }
}; 