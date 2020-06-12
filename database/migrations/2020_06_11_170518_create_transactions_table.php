<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('vendor_id');
            $table->string('number');
            $table->double('amount')->default(0);
            $table->tinyInteger('status')->default(0); // 0 = On progress (harus verifikasi vendor); 1 = Disetujui; 2 = Ditolak vendor;
            $table->string('payment_method')->default('cash');
            
            $table->foreign('customer_id')
                    ->references('id')
                    ->on('users');

            $table->foreign('vendor_id')
                    ->references('id')
                    ->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
