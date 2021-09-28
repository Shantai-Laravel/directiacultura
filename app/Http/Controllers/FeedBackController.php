<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\FeedBack;
use Session;
use App\Models\Page;

class FeedBackController extends Controller
{
    public function index() {
        $page = Page::where('alias', 'contacts')->first();
        return view('front.pages.contacts', compact('page'));
    }

    public function feedBack(Request $request)
    {
        $validator = validator($request->all(), [
          'name' => 'required|min:5',
          'email' => 'required|email',
          'message' => 'required|min:5'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors'=>$validator->errors()->all()], 400);
        }

        // $to = getContactInfo('emailfront')->translationByLanguage($this->lang->id)->first()->value;
        // $subject = 'Feedback form';
        //
        // $message = view('mails.feedBack', ['user' => $userData])->render();
        // $headers  = 'MIME-Version: 1.0' . "\r\n";
        // $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
        //
        // mail($to, $subject, $message, $headers);

        $feedback = new FeedBack();
        $feedback->first_name = $request->get('name');
        $feedback->email = $request->get('email');
        $feedback->message = $request->get('message');
        $feedback->status = 'new';

        $feedback->save();

        return response()->json(trans('front.contacts.success'));
    }

}
