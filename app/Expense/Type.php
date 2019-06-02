<?php

namespace App\LandMS;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    protected $table= 'tbl_expense_type';
    protected $fillable = ['name'];
    protected $sortable = [
    	'id', 'name', 'created_at'
    ];

    protected $searchable = [
    	'name'
    ];

    protected $allowedFilters = [];
}
