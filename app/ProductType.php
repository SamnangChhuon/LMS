<?php

namespace LandMS;

use Illuminate\Database\Eloquent\Model;

class ProductType extends Model
{
    protected $table="tbl_product_type";
    protected $fillable = ['type_name', 'status'];
}
