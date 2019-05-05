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
            $table->string('cid', 20);
            $table->string('name');
            $table->string('code', 25)->nullable();
            $table->text('description')->nullable();
            $table->string('categoryid', 10)->nullable();
            $table->string('typeid', 10)->nullable();
            $table->double('price', 16, 2)->nullable()->unsigned();
            $table->string('image', 10)->default('no');
            $table->string('promotion', 10)->default('no');
            $table->string('status', 10)->default('active');
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
