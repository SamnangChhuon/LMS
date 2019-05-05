<?php

namespace LandMS;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\HasApiTokens;


class Customer extends Model
{
    use Notifiable, HasApiTokens;

    protected $table= 'tbl_customers';
    protected $fillable = [
        'firstname', 'lastname', 'sex', 'companyname', 'dob', 'type',
        'businessphone', 'personalphone', 'fax', 'email', 'website', 'twitter', 'line', 'remarkcontact', 'postalcode', 'street', 'city', 'country', 'remarkaddress', 'status'
    ];
}
