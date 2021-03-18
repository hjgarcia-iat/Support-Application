<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $casts = [
        'email_processed' => 'boolean',
    ];

    protected $guarded = [];

    public function files()
    {
        return $this->hasMany(File::class);
    }

}