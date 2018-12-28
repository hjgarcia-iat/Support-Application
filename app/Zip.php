<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Zip extends Model
{
    /**
     * Table Name
     *
     * @var string
     */
    protected $table = 'zipcodes';


    /**
     * Protected fields
     *
     * @var array
     */
    protected $fillable = [
        'zip_code',
        'city',
        'state',
        'abbr',
    ];
}
