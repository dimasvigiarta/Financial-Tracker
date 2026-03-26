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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete(); // Milik User Siapa?
            $table->foreignId('category_id')->constrained()->cascadeOnDelete(); // Kategori Apa?
            $table->string('description'); // Keterangan Transaksi
            $table->decimal('amount', 15, 2); // Jumlah Uang
            $table->enum('type', ['income', 'expense']); // Tipe: Pemasukan / Pengeluaran
            $table->date('date'); // Tanggal Transaksi
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
