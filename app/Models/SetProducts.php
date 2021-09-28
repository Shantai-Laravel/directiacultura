<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SetProducts extends Model
{
    protected $table = 'set_product';

    protected $fillable = [
        'set_id', 'product_id', 'src',
    ];

    public function set()
    {
        return $this->hasOne(Set::class, 'id', 'set_id');
    }

    public function product() {
        return $this->hasOne(Product::class, 'id', 'product_id');
    }
    //
    // public function translation($lang = 1)
    // {
    //     return $this->hasOne(SetTranslation::class, 'set_id')->where('lang_id', $lang);
    // }
}
