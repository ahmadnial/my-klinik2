<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tc_mr', function (Blueprint $table) {
            $table->bigInteger('fs_mr');
            $table->string('fs_nama');
            $table->string('fs_tgl_lahir');
            $table->string('fs_jenis_kelamin');
            $table->string('fs_alamat');
            $table->string('fs_no_hp');
            $table->string('fs_user')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
