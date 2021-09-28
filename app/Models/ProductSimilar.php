<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductSimilar extends Model
{
  protected $table = 'similar_products';

    protected $fillable = ['category_id'];
}
