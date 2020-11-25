<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ingredients extends Model
{
    use SoftDeletes;
    protected $table = 'ingredients';
    protected $fillable = ['name'];
}
