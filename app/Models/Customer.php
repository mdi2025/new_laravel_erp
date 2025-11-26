<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $guarded = [];

    protected $casts = [
        'attachments'             => 'array',
        'shipping_address'        => 'array',
        'billing_address'         => 'array',
        'notes'                   => 'array',
        'sez_applicable'          => 'boolean',
        'tcs_applicable'          => 'boolean',
        'tds_applicable'          => 'boolean',
        'delivery_date_applicable'=> 'boolean',
        'inactive'                => 'boolean',
        'excise_duty_applicable'  => 'boolean',
    ];
}