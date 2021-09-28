<?php

namespace App\Providers;

use App\Models\Lang;
use App\Models\Module;
use App\Models\Cart;
use App\Models\Page;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
     public function boot()
     {
         // TEMP:
         session(['applocale' => Lang::where('default', 1)->first()->lang]);

         $currentLang = Lang::where('lang', \Request::segment(1))->first()->lang ?? session('applocale');

         session(['applocale' => $currentLang]);

          \App::setLocale($currentLang);

         // ENDTEMP

         View::share('langs', Lang::all());

         View::share('lang', Lang::where('lang', session('applocale') ?? Lang::first()->lang)->first());

         View::share('menu', Module::where('parent_id', 0)->orderBy('position')->get());

         $langForURL = '';
         if ($currentLang != 'ro') {
             $langForURL = $currentLang;
         }
         View::share('urlLang', $langForURL);

         $seo['title'] = 'boiar.md';
         $seo['description'] = 'boiar.md';
         $seo['keywords'] = 'boiar.md';

         $categoryEvents = Category::where('alias', 'events')->first();
         $headerEvents = Post::where('category_id', $categoryEvents->id)->orderBy('id', 'desc')->limit(3)->get();

         $categoryInstitutions = Category::where('alias', 'institutions')->first();
         $headerInstitutions = Post::where('category_id', $categoryInstitutions->id)->orderBy('id', 'desc')->get();

         View::share('seo', $seo);
         View::share('pureAlias', false);
         View::share('prefix', '');
         View::share('headerEvents', $headerEvents);
         View::share('headerInstitutions', $headerInstitutions);

         $this->getUserId();
     }

    public function getUserId()
    {
        $user_id = md5(rand(0, 9999999).date('Ysmsd'));

        if (\Cookie::has('user_id')) {
            $value = \Cookie::get('user_id');
        }else{
            setcookie('user_id', $user_id, time() + 10000000, '/');
            $value = \Cookie::get('user_id');
        }
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
