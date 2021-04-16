<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory;

    const DEFAULT = 'Default';
    const LOW = 'Low';
    const MEDIUM = 'Medium';
    const HIGH = 'High';

    protected $guarded = [];
}
