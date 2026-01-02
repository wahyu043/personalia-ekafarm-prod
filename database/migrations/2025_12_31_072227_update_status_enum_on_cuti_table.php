<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement("
            ALTER TABLE cuti
            MODIFY status ENUM(
                'menunggu_atasan',
                'menunggu_hr',
                'disetujui',
                'ditolak'
            ) NOT NULL DEFAULT 'menunggu_atasan'
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("
            ALTER TABLE cuti
            MODIFY status ENUM(
                'menunggu',
                'disetujui',
                'ditolak'
            ) NOT NULL DEFAULT 'menunggu'
        ");
    }
};
