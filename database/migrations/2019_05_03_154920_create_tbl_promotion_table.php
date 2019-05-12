<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblPromotionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_promotion', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('cid')->index()->unsigned()->default('0');
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('valid_from_date', 10);
            $table->string('valid_to_date', 10);
            $table->string('pro_discount_type', 10)->nullable();
            $table->string('pro_discount_num', 10)->nullable();
            $table->string('pro_discount_product', 10)->nullable();
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
        Schema::dropIfExists('tbl_promotion');
    }
}
