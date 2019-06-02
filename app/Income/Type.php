<?php

namespace App\LandMS;

use Illuminate\Database\Eloquent\Model;

class Income extends Model
{
    protected $table= 'tbl_income_type';
    protected $fillable = ['name'];
    protected $sortable = [
    	'id', 'name', 'created_at'
    ];

    protected $searchable = [
    	'name'
    ];

    protected $allowedFilters = [];
}
