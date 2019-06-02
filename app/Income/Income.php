<?php

namespace App\LandMS;

use Illuminate\Database\Eloquent\Model;

class Income extends Model
{
    protected $table= 'tbl_income';
    protected $fillable = ['payment_id', 'income_type_id', 'income_date', 'amount', 'description', 'status'];
}
