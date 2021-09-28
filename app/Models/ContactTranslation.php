<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactTranslation extends Model
{
    protected $fillable = ['lang_id', 'contact_id', 'value'];

    protected $table = 'contacts_translation';

    public function contact()
    {
        return $this->belongsTo(Contact::class);
    }
}
