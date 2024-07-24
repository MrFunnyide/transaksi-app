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
        Schema::create('t_sales_det', function (Blueprint $table) {
            $table->unsignedInteger('sales_id');
            $table->foreign('sales_id')->references('id')->on('t_sales')->onDelete('cascade');
            $table->unsignedInteger('barang_id');
            $table->foreign('barang_id')->references('id')->on('m_barang')->onDelete('cascade');
            $table->decimal('harga_bandrol', 9, 2);
            $table->integer('qty');
            $table->decimal('diskon_pct', 5, 2);
            $table->decimal('diskon_nilai', 9, 2);
            $table->decimal('harga_diskon', 9, 2);
            $table->decimal('total', 9, 2);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_sales_det');
    }
};
