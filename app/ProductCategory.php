<?php

namespace LandMS;

use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;

class ProductCategory extends Model
{
    use Notifiable, HasApiTokens;

    protected $table="tbl_product_category";
    protected $fillable = ['cate_name', 'status'];
}
