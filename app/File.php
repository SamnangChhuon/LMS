<?php

namespace LandMS;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $table= 'tbl_file';
    protected $fillable = ['cid', 'file', 'status'];
}
