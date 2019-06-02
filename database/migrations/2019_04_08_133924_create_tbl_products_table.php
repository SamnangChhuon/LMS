<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('product_id')->index()->unsigned()->default('0');
            $table->string('name');
            $table->string('code', 25)->nullable();
            $table->text('description')->nullable();
            $table->bigInteger('typeid')->index()->unsigned()->default('0');
            $table->double('price', 16, 2)->nullable()->unsigned();
            $table->string('status', 10)->default('available');
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
        Schema::dropIfExists('tbl_products');
    }
}
