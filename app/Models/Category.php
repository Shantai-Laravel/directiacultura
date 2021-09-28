<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';

    protected $fillable = ['parent_id', 'alias', 'image', 'deleted', 'level', 'position'];

    public function translations()
    {
        return $this->hasMany(CategoryTranslation::class);
    }

    public function translation()
    {
        $lang = Lang::where('lang', session('applocale'))->first()->id ?? Lang::first()->id;

        return $this->hasOne(CategoryTranslation::class)
                    ->where('lang_id', $lang);
    }

    public function translationByLanguage($lang)
    {
        return $this->hasMany(CategoryTranslation::class)
                    ->where('lang_id', $lang);
    }

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function child() {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function posts() {
        return $this->hasMany(Post::class);
    }
}
