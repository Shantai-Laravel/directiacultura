<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lang;
use App\Models\Post;
use App\Models\PostTranslation;
use App\Models\Category;
use App\Models\CategoryTranslation;

class BlogController extends Controller
{
    public function getEvents() {
        $category = Category::where('alias', 'events')->first();
        $this->_ifExists($category);

        $posts = Post::where('category_id', $category->id)->orderBy('date', 'desc')->take(6)->get();
        $recentPosts = Post::where('category_id', $category->id)->orderBy('id', 'desc')->limit(4)->get();

        return view('front.posts.events', compact('posts', 'recentPosts'));
    }

    public function getEventsBySlug($slug)
    {
        $category = Category::where('alias', 'events')->first();
        $this->_ifExists($category);

        $post = Post::where('alias', $slug)->where('category_id', $category->id)->first();
        $this->_ifExists($post);

        return view('front.posts.one-event', compact('post'));
    }

    public function getInstitutions() {
        $category = Category::where('alias', 'institutions')->first();
        $this->_ifExists($category);

        $posts = Post::where('category_id', $category->id)->get();

        return view('front.posts.institutions', compact('posts', 'recentPosts'));
    }

    public function getInstitutionBySlug($slug)
    {
        $category = Category::where('alias', 'institutions')->first();
        $this->_ifExists($category);

        $post = Post::where('alias', $slug)->where('category_id', $category->id)->first();
        $this->_ifExists($post);

        return view('front.posts.one-institution', compact('post'));
    }

    public function addMorePosts() {
        if(request('categoryId') > 0) {
          $posts = Post::where('category_id', request('categoryId'))->orderBy('date', 'desc')->take(request('count') + 6)->get();
        } else {
          $posts = Post::orderBy('date', 'desc')->take(request('count') + 6)->get();
        }
        $data['posts'] = view('front.inc.items', compact('posts'))->render();
        return json_encode($data);
    }

    // get SEO data for a page
    private function getSeo($page){
        $seo['seo_title'] = $page->translationByLanguage($this->lang->id)->first()->meta_title;
        $seo['seo_keywords'] = $page->translationByLanguage($this->lang->id)->first()->meta_keywords;
        $seo['seo_description'] = $page->translationByLanguage($this->lang->id)->first()->meta_description;

        return $seo;
    }

    private function _ifExists($object){
        if (is_null($object)) {
            return redirect()->route('404')->send();
        }
    }

}
