<?php

namespace Admin\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\ContactTranslation;

class ContactController extends Controller
{
    public function index()
    {
      $contacts = Contact::all();

      return view('admin::admin.contacts.index', compact('contacts'));
    }

    public function store(Request $request)
    {
        $this->validate(request(), array(
          'fisc' => 'nullable|numeric',
          'nds' => 'nullable|numeric',
          'sign' => 'mimes:jpeg,jpg,png'
        ));

        foreach ($request->except('_token') as $key => $value):
            $this->setContactInfo($key, $value);
        endforeach;

        return redirect()->route('contacts.index');
    }

    public function storeMultilang(Request $request) {
      foreach ($request->except('_token') as $key => $value):
        $this->setContactInfoMulti($request, $key);
      endforeach;

     return redirect()->route('contacts.index');
    }

    private function setContactInfo($field, $value) {
      $contact = Contact::where('title', $field)->first();

      if($contact->count() > 0) {

          if($field == 'sign') {

            if ($contact->translations()->first() && is_file(public_path('images/contacts/'.$contact->translations()->first()->value))) {
                unlink(public_path('images/contacts/'.$contact->translations()->first()->value));
            }

            $name = time() . '-' . $value->getClientOriginalName();
            $value->move('images/contacts', $name);
            $value = $name;
          }

          $contact->translations()->delete();

          if(is_array($value)) {
            foreach ($value as $contact_value):
                if($contact_value != '') {
                    $contact->translations()->create([
                        'value' => $contact_value
                    ]);
                }
            endforeach;
          } else {
            if($value != '') {
                $contact->translations()->create([
                    'value' => $value
                ]);
            }
          }
      }
    }

    private function setContactInfoMulti($request, $request_key) {
        $contact = Contact::where('title', substr($request_key, 0, -3))->first();
          foreach ($request->get($request_key) as $key => $value) {
            if($contact->count() > 0) {
              ContactTranslation::where('id', $key)->where('contact_id', $contact->id)->delete();
              foreach ($this->langs as $lang):
                  if($value != '' && $request_key == $contact->title.'_'.$lang->lang) {
                    $contact->translations()->create([
                        'lang_id' => $lang->id,
                        'value' => $value
                    ]);
                  }
              endforeach;
            }
        }
    }

    public function deleteSign() {
        $sign = Contact::where('title', 'sign')->first();

        if (is_file(public_path('images/contacts/'.$sign->translations()->first()->value))) {
            unlink(public_path('images/contacts/'.$sign->translations()->first()->value));
        }

        $sign->translations()->delete();

        return 'true';
    }
}
