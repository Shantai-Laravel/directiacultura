<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{
    
    protected $table = 'collections';

    protected $fillable = ['alias', 'banner', 'position', 'active'];

    public function translations()
    {
        return $this->hasMany(CollectionTranslation::class);
    }

    public function translation($lang = 1)
    {
        return $this->hasOne(CollectionTranslation::class , 'collection_id')
            ->where('lang_id', $lang);
    }

    public function sets()
    {
        return $this->hasMany(Set::class)
            ->where('active', 1)
            ->orderBy('position', 'asc');
    }

}
