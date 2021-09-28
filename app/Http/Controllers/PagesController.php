<?php

namespace App\Http\Controllers;

use App\Models\Lang;
use App\Models\Page;
use App\Models\Category;
use App\Models\Post;
use App\Models\Gallery;
use App\Models\General;

class PagesController extends Controller
{
    public function index() {
        $page = Page::where('alias', 'home')->first();

        if (is_null($page)) {
            return redirect()->route('404');
        }

        $category = Category::where('alias', 'events')->first();
        $posts = Post::where('category_id', $category->id)->limit(10)->orderBy('created_at', 'desc')->get();

        $bannerGallery = Gallery::where('alias', 'home')->first();

        $generalInfo = General::all();

        $seoData = $this->getSeo($page);
        return view('front.pages.home', compact('seoData', 'page', 'posts', 'bannerGallery', 'generalInfo'));
    }

    public function getPages($slug)
    {
        $page = Page::where('alias', $slug)->first();
        if (is_null($page)) {
            return redirect()->route('404');
        }

        if (view()->exists('front/pages/'.$slug)) {
            $seoData = $this->getSeo($page);
            return view('front.pages.'.$slug, compact('seoData', 'page'));
        }else{
            $seoData = $this->getSeo($page);
            return view('front.pages.default', compact('seoData', 'page'));
        }
    }

    // get SEO data for a page
    private function getSeo($page){
        $seo['seo_title'] = $page->translation($this->lang->id)->first()->meta_title;
        $seo['seo_keywords'] = $page->translation($this->lang->id)->first()->meta_keywords;
        $seo['seo_description'] = $page->translation($this->lang->id)->first()->meta_description;

        return $seo;
    }

    public function get404()
    {
        return view('front.404');
    }

}
