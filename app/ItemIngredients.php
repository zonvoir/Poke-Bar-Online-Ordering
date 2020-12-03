<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ItemIngredients extends Model
{
    use SoftDeletes;
    protected $table = 'item_ingredients';
   /* protected $fillable = [
        'name'
    ];*/
    public function ingredients()
    {
        return $this->belongsTo('App\Ingredients','ingredient_id');
    }
}
