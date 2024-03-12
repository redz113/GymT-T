<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            // $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('discount_id')->nullable();
            $table->unsignedBigInteger('package_id');
            $table->date('date_start');
            $table->date('date_end');
            $table->unsignedBigInteger('pt_id')->nullable(); // role : pt
            $table->unsignedBigInteger('total_money');
            $table->unsignedBigInteger('payment_method');
            $table->unsignedBigInteger('status')->default(0);
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
        Schema::dropIfExists('orders');
    }
};
