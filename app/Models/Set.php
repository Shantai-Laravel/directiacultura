<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Set extends Model
{
    protected $table = 'sets';

    protected $fillable = [
        'collection_id', 'alias', 'price', 'price_lei', 'discount', 'position', 'on_home', 'active'
    ];

    protected $appends = ['url'];

    public function getUrlAttribute() {
        return 'collections/'.$this->alias;
    }

    public function translations()
    {
        return $this->hasMany(SetTranslation::class);
    }

    public function translation($lang = 1)
    {
        return $this->hasOne(SetTranslation::class, 'set_id')->where('lang_id', $lang);
    }

    public function setProduct($productId)
    {
        return $this->hasOne(SetProducts::class, 'set_id', 'id')->where('product_id', $productId);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'set_product');
    }

    public function galleryItems()
    {
        return $this->hasMany(SetGallery::class, 'set_id', 'id')->orderBy('main', 'desc');
    }

    public function photos()
    {
        return $this->hasMany(SetGallery::class, 'set_id', 'id')->where('type', 'photo')->orderBy('main', 'desc');
    }

    public function videos()
    {
        return $this->hasMany(SetGallery::class, 'set_id', 'id')->where('type', 'video');
    }

    public function mainPhoto()
    {
        return $this->hasOne(SetGallery::class, 'set_id', 'id')->where('type', 'photo')->orderBy('main', 'desc');
    }

    public function collection()
    {
        return $this->hasOne(Collection::class, 'id', 'collection_id');
    }
}
