<?php

namespace LandMS;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table= 'tbl_products';
    protected $fillable = ['name','code', 'description', 'categoryid', 'typeid', 'price', 'image', 'status'];
}
