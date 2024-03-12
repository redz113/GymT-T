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
        Schema::create('packages', function (Blueprint $table) {
            $table->id();
            $table->string('package_name');
            $table->unsignedBigInteger('subject_id');
            $table->string('avatar')->nullable();
            $table->unsignedBigInteger('price');
            $table->unsignedBigInteger('price_sale')->default(0);
            $table->unsignedBigInteger('into_price');
            // $table->unsignedBigInteger('price_costs_incurred')->default(0);
            $table->unsignedBigInteger('total_session_pt')->nullable();
            $table->unsignedBigInteger('week_session_pt')->nullable();
            $table->string('description', 10000);
            $table->string('short_description',1000);
            $table->unsignedInteger('status')->default(1);
            $table->unsignedInteger('set_pt')->default(0);
            $table->unsignedBigInteger('type_package');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('packages');
    }
};
