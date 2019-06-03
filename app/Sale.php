<?php

namespace LandMS;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $table= 'tbl_sale';
    protected $fillable = ['product_id','customer_id','price', 'description', 'product_status', 'promotion_id', 'principal_amount',
    'payment_date', 'payment_method', 'staff_id', 'status'];
}
