<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblIncomeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_income', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('cid')->index()->unsigned()->default('0');
            $table->string('exin_typeid', 10);
            $table->string('amount');
            $table->string('date', 10);
            $table->text('description')->nullable();
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
        Schema::dropIfExists('tbl_income');
    }
}
