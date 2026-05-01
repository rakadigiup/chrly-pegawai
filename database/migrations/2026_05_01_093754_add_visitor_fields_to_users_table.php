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
        Schema::table('users', function (Illuminate\Database\Schema\Blueprint $table) {
            $table->text('members')->nullable(); // anggota
            $table->integer('member_count')->nullable(); // jumlah anggota
            $table->string('phone')->nullable(); // no hp
            $table->date('arrival_date')->nullable(); // tanggal datang
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Illuminate\Database\Schema\Blueprint $table) {
            $table->dropColumn(['members', 'member_count', 'phone', 'arrival_date']);
        });
    }
};
