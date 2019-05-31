<?php

namespace LandMS;

use Illuminate\Database\Eloquent\Model;
use LandMS\Support\Dataviewer;

class Product extends Model
{
    protected $table= 'tbl_products';
    protected $fillable = ['name','code', 'description', 'categoryid', 'typeid', 'price', 'image', 'status'];

    use Dataviewer;

    protected $allowedFilters = [
        'id' ,'name', 'code', 'status', 'created_at',
    ];

    protected $orderable = [
        'id' ,'name', 'code', 'status', 'created_at',
    ];
}
