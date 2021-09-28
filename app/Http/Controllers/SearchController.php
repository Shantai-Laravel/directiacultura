<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lang;
use App\Models\Post;
use App\Models\PostTranslation;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $posts = [];
        if ($request->get('value')) {
            $searchResult = PostTranslation::where('title', 'like',  '%'.$request->get('value').'%')
                                        ->orWhere('body', 'like',  '%'.$request->get('value').'%')
                                        ->pluck('post_id')->toArray();
            $findPosts = Post::whereIn('id', $searchResult)->limit(5)->get();
        }

        $data = view('front.inc.searchResults', compact('findPosts'))->render();

        return json_encode($data);
    }
}
