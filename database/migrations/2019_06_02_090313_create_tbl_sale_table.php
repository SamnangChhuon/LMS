<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblSaleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_sale', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('product_id')->index()->unsigned()->default('0');
            $table->bigInteger('customer_id')->index()->unsigned()->default('0');
            $table->double('price', 16, 2)->nullable()->unsigned();
            $table->text('description')->nullable();
            $table->string('product_status')->default('active');
            $table->bigInteger('promotion_id')->index()->unsigned()->default('0');
            $table->double('principal_amount', 16, 2)->nullable()->unsigned();
            $table->string('payment_date', 10);
            $table->string('payment_method');
            $table->string('staff_id');
            $table->string('status')->default('active');
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
        Schema::dropIfExists('tbl_sale');
    }
}
