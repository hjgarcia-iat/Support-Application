<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Zip extends Model
{
    use HasFactory;

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
