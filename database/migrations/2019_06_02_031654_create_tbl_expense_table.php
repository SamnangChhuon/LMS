<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblExpenseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_expense', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('payment_id')->unsigned();
            $table->integer('expense_type_id')->unsigned();
            $table->string('expense_date', 10);
            $table->double('amount', 16, 2)->nullable()->unsigned();
            $table->text('description')->nullable();
            $table->string('status')->default('active');
            $table->timestamps();
        });

        Schema::create('tbl_expense_type', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
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
        Schema::dropIfExists('tbl_expense');
        Schema::dropIfExists('tbl_expense_type');

    }
}