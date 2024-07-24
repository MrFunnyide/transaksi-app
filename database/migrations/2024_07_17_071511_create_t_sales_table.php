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
        Schema::create('t_sales', function (Blueprint $table) {
            $table->increments('id');
            $table->string('kode', 15)->unique();
            $table->date('tgl');
            $table->unsignedInteger('cust_id');
            $table->foreign('cust_id')->references('id')->on('m_customer')->onDelete('cascade');
            $table->decimal('subtotal', 9, 2);
            $table->decimal('diskon', 9, 2);
            $table->decimal('ongkir', 9, 2);
            $table->decimal('total_bayar', 9, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_sales');
    }
};
