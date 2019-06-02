<?php

namespace LandMS;

use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    protected $table= 'tbl_promotion';
    protected $fillable = ['product_id', 'name', 'description', 'valid_from_date', 'valid_to_date', 'pro_discound_type', 'pro_discount_num', 'pro_discount_product', 'status'];
}
