<?php

namespace App\LandMS;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    protected $table= 'tbl_expense';
    protected $fillable = ['payment_id', 'expense_type_id', 'expense_date', 'amount', 'description', 'status'];
}
